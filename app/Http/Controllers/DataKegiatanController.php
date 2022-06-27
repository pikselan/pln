<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Pelanggan;
use App\DataKegiatan;

use Illuminate\Support\Str;
use App\Exports\DataKegiatanExport;
use App\Exports\DataKegiatanExcelExport;

use Maatwebsite\Excel\Facades\Excel;
use PDF;
use ZipArchive;
use Session;
use App\Jobs\ExportPdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Validator,Redirect,Response,File;

class DataKegiatanController extends Controller
{
    // public function index()
    // {
    //     $siswa = Siswa::all();
    //     return view('siswa',['siswa'=>$siswa]);
    // }
  
    public function export_excel($from, $to)
    {
        $r_from=strtotime($from);
        $r_to=strtotime("+23 hours +59 minutes +59 seconds", strtotime($to));
        $data = DataKegiatan::whereBetween('created_at', [strftime("%Y-%m-%d %H:%M:%S", $r_from), strftime("%Y-%m-%d %H:%M:%S", $r_to)])->get();
        return Excel::download(new DataKegiatanExcelExport($data), 'data.xlsx');
        
        // return (new DataKegiatanExcelExport($r_from,$r_to))->download('data.xlsx');
        // return response()->json($data);
    }
  
    public function export_single_excel($id)
    {
      $data = DataKegiatan::find($id);
      $created=strftime("%d.%m.%y-%H.%M", strtotime($data->created_at));
      return Excel::download(new DataKegiatanExport($data), $created.'-'.$data->pelanggan->id_pelanggan.'.xlsx');
    }
  
    public function export_pdf_old($from, $to)
    {
      $name_dir = Str::random(10);

      $missing = Storage::disk('pdf')->makeDirectory($name_dir);

      $r_from=strtotime($from);
      $r_to=strtotime("+23 hours +59 minutes +59 seconds", strtotime($to));
      $query = DataKegiatan::whereBetween('created_at', [strftime("%Y-%m-%d %H:%M:%S", $r_from), strftime("%Y-%m-%d %H:%M:%S", $r_to)])->get();
      if(count($query)) {
        foreach ($query as $data) {
          $created=strftime("%d.%m.%y-%H.%M", strtotime($data->created_at));
          PDF::loadView('exportpdf',['data'=>$data])->setPaper('a4', 'potrait')->setWarnings(false)->save('storage/doc/pdf/'.$name_dir.'/'.$created.'-'.$data->pelanggan->id_pelanggan.'.pdf');
        }
  
        $zip = new ZipArchive;
        $name_zip = 'storage/doc/pdf/'.strftime('%d%m%y', $r_from).'-'.strftime('%d%m%y', $r_to).'-'.Str::random(4).'.zip';
  
        if (true === ($zip->open(strftime($name_zip), ZipArchive::CREATE))) {
            foreach (Storage::disk('pdf')->allFiles($name_dir) as $file) {
                $name = basename($file);
                if ($name !== '.gitignore') {
                    $zip->addFile(public_path('storage/doc/pdf/'.$name_dir.'/'.$name), $name);
                }
            }
            $zip->close();
        }
  
        Storage::disk('pdf')->deleteDirectory($name_dir);
        return response()->download($name_zip);
      } else {
        Session::flash('empty','Data yang diekspor tidak ditemukan!');
        return redirect('admin/data-kegiatans');
      }
    }

    public function export_pdf($from, $to, Request $request)
    {
      $r_from=strtotime($from);
      $r_to=strtotime("+23 hours +59 minutes +59 seconds", strtotime($to));
      if(DataKegiatan::whereBetween('created_at', [strftime("%Y-%m-%d %H:%M:%S", $r_from), strftime("%Y-%m-%d %H:%M:%S", $r_to)])->exists())
      {
        $name_zip = strftime('%d%m%y', $r_from).'-'.strftime('%d%m%y', $r_to).'-'.Str::random(4).'.zip';
        $details['from'] = $from;
        $details['to'] = $to;
        $details['name_zip'] = $name_zip;
        
        ExportPdf::dispatch($details);

        $host = $request->getSchemeAndHttpHost();
        Session::flash('progress','Mohon tunggu proses pengarsipan');
        Session::flash('link_zip',$host.'/storage/doc/pdf/'.$name_zip);
        return redirect('admin/data-kegiatans');
      } else {
        Session::flash('empty','Data yang diekspor tidak ditemukan!');
        return redirect('admin/data-kegiatans');
      }
    }
  
    public function export_single_pdf($id)
    {
      $data = DataKegiatan::find($id);
      $created=strftime("%d.%m.%y-%H.%M", strtotime($data->created_at));
      return PDF::loadView('exportpdf',['data'=>$data])->setPaper('a4', 'potrait')->setWarnings(false)->download($created.'-'.$data->pelanggan->id_pelanggan.'.pdf');
    }

    public function select(Request $request)
    {
        // $datakegiatan = DataKegiatan::with('pelanggan:id,id_pelanggan,nama,alamat,tarif_daya')->where('user_id', $request->user()->id)->orderBy('created_at', 'desc')->get();
        $datakegiatan = DataKegiatan::select('id','kegiatan_id','pelanggan_id','data_sesudah','no_ba','koordinat','kesimpulan','created_at')->with('pelanggan:id,id_pelanggan,nama,alamat,tarif_daya','kegiatan:id,jenis')->whereYear('data_kegiatans.created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('user_id', $request->user()->id)->has('pelanggan')->orderBy('created_at', 'desc')->get();
        return response()->json($datakegiatan);
    }

    public function select_summary(Request $request)
    {
        $timetoday = Carbon::today()->toDateString();
        $timemonth = Carbon::now()->month;

        $dataPetugasToday = DB::table('data_kegiatans')->join('users', 'users.id', '=', 'data_kegiatans.user_id')->select('data_kegiatans.user_id', 'users.name', DB::raw('count(*) as total'))->whereDate('data_kegiatans.created_at', $timetoday)->orderByDesc('total')->groupBy('user_id')->get();
        $dataPetugasMonth = DB::table('data_kegiatans')->join('users', 'users.id', '=', 'data_kegiatans.user_id')->select('data_kegiatans.user_id', 'users.name', DB::raw('count(*) as total'))->whereMonth('data_kegiatans.created_at', $timemonth)->orderByDesc('total')->groupBy('user_id')->get();
        $dataArrayPetugas = DB::table('data_kegiatans')->join('users', 'users.id', '=', 'data_kegiatans.user_id')->select('data_kegiatans.created_at as x', DB::raw('count(*) as y'))->whereMonth('data_kegiatans.created_at', $timemonth)->where('user_id', $request->user()->id)->groupByRaw('DATE(data_kegiatans.created_at)')->get();

        $resultArray = array(
          'datapetugastoday' => $dataPetugasToday, 
          'datapetugasmonth' => $dataPetugasMonth,
          'datalistpetugas' => $dataArrayPetugas
        );

        return response()->json($resultArray);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
          'kegiatan_id' => 'required',
          'pelanggan_id' => 'required',
          'foto_kwh' => 'nullable|mimes:jpeg,jpg,bmp,png',
          'foto_mcb' => 'nullable|mimes:jpeg,jpg,bmp,png',
          'foto_box_app' => 'nullable|mimes:jpeg,jpg,bmp,png',
          'foto_modem' => 'nullable|mimes:jpeg,jpg,bmp,png',
          'foto_ba' => 'nullable|mimes:jpeg,jpg,bmp,png',
          'foto_bangunan' => 'nullable|mimes:jpeg,jpg,bmp,png',
          'foto_1' => 'nullable|mimes:jpeg,jpg,bmp,png',
          'foto_2' => 'nullable|mimes:jpeg,jpg,bmp,png',
        ]);

        if ($validator->fails()) {          
          return response()->json(['error'=>$validator->errors()], 401);
        } 

        $pelanggan = Pelanggan::select('id','id_pelanggan','nama','tarif_daya','alamat','nomor_meter','merk_meter','type_meter','gsm','provider','nomor_modem','merk_modem','type_modem','berkas','nomor_box','nomor_urut')->where('id', $request->pelanggan_id)->latest()->first();

        $data = new DataKegiatan;

        $data->kegiatan_id = $request->kegiatan_id;
        $data->data_sesudah = $request->data_sesudah;
        $data->no_ba = $request->no_ba;
        $data->pelanggan_id = $request->pelanggan_id;
        $data->koordinat = $request->koordinat;
        $data->kondisi_box = $request->kondisi_box;
        $data->kondisi_meter = $request->kondisi_meter;
        $data->shuntrip = $request->shuntrip;
        $data->pembatas = $request->pembatas;
        $data->merek_pembatas = $request->merek_pembatas;
        $data->arus_pembatas = $request->arus_pembatas;
        $data->ratio_ct = $request->ratio_ct;
        $data->cosphi = $request->cosphi;
        $data->tegangan_r = $request->tegangan_r;
        $data->tegangan_s = $request->tegangan_s;
        $data->tegangan_t = $request->tegangan_t;
        $data->arus_r = $request->arus_r;
        $data->arus_s = $request->arus_s;
        $data->arus_t = $request->arus_t;
        $data->wbp = $request->wbp;
        $data->lwbp1 = $request->lwbp1;
        $data->lwbp2 = $request->lwbp2;
        $data->total = $request->total;
        $data->kvarh = $request->kvarh;
        $data->pintu_luar_atas = $request->pintu_luar_atas;
        $data->pintu_luar_bawah = $request->pintu_luar_bawah;
        $data->terminal_kwh = $request->terminal_kwh;
        $data->modem = $request->modem;
        $data->peruntukan = $request->peruntukan;
        $data->kesimpulan = $request->kesimpulan;
        
        $data->nomor_modem_baru = $request->nomor_modem_baru;
        $data->merk_modem_baru = $request->merk_modem_baru;
        $data->type_modem_baru = $request->type_modem_baru;
        $data->gsm_baru = $request->gsm_baru;
        $data->provider_baru = $request->provider_baru;
        $data->segel_lama = $request->segel_lama;
        $data->segel_baru = $request->segel_baru;
        
        $data->telepon_pelanggan = $request->telepon_pelanggan;

        $data->id_pelanggan = $pelanggan->id_pelanggan;
        $data->nama = $pelanggan->nama;
        $data->alamat = $pelanggan->alamat;
        $data->nomor_meter = $pelanggan->nomor_meter;
        $data->merk_meter = $pelanggan->merk_meter;
        $data->type_meter = $pelanggan->type_meter;
        $data->gsm = $pelanggan->gsm;
        $data->provider = $pelanggan->provider;
        $data->nomor_modem = $pelanggan->nomor_modem;
        $data->merk_modem = $pelanggan->merk_modem;
        $data->type_modem = $pelanggan->type_modem;
        $data->tarif_daya = $pelanggan->tarif_daya;
        $data->data_box = $pelanggan->berkas;
        $data->nomor_box = $pelanggan->nomor_box;
        $data->nomor_urut = $pelanggan->nomor_urut;

        $data->user_id = $request->user()->id;

        if($request->file('foto_kwh')){
          $ext_foto_kwh = $request->foto_kwh->extension();
          $foto_kwh = $request->foto_kwh->storeAs('public/data-kegiatans', Str::random(20).".".$ext_foto_kwh);
          $data->foto_kwh = str_replace("public/","",$foto_kwh); 
        }
        if($request->file('foto_mcb')){
          $ext_foto_mcb = $request->foto_mcb->extension();
          $foto_mcb = $request->foto_mcb->storeAs('public/data-kegiatans', Str::random(20).".".$ext_foto_mcb);
          $data->foto_mcb = str_replace("public/","",$foto_mcb); 
        }
        if($request->file('foto_box_app')){
          $ext_foto_box_app = $request->foto_box_app->extension();
          $foto_box_app = $request->foto_box_app->storeAs('public/data-kegiatans', Str::random(20).".".$ext_foto_box_app);
          $data->foto_box_app = str_replace("public/","",$foto_box_app); 
        }
        if($request->file('foto_modem')){
          $ext_foto_modem = $request->foto_modem->extension();
          $foto_modem = $request->foto_modem->storeAs('public/data-kegiatans', Str::random(20).".".$ext_foto_modem);
          $data->foto_modem = str_replace("public/","",$foto_modem); 
        }
        if($request->file('foto_ba')){
          $ext_foto_ba = $request->foto_ba->extension();
          $foto_ba = $request->foto_ba->storeAs('public/data-kegiatans', Str::random(20).".".$ext_foto_ba);
          $data->foto_ba = str_replace("public/","",$foto_ba); 
        }
        if($request->file('foto_bangunan')){
          $ext_foto_bangunan = $request->foto_bangunan->extension();
          $foto_bangunan = $request->foto_bangunan->storeAs('public/data-kegiatans', Str::random(20).".".$ext_foto_bangunan);
          $data->foto_bangunan = str_replace("public/","",$foto_bangunan); 
        }
        if($request->file('foto_1')){
          $ext_foto_1 = $request->foto_1->extension();
          $foto_1 = $request->foto_1->storeAs('public/data-kegiatans', Str::random(20).".".$ext_foto_1);
          $data->foto_1 = str_replace("public/","",$foto_1); 
        }
        if($request->file('foto_2')){
          $ext_foto_2 = $request->foto_2->extension();
          $foto_2 = $request->foto_2->storeAs('public/data-kegiatans', Str::random(20).".".$ext_foto_2);
          $data->foto_2 = str_replace("public/","",$foto_2); 
        }

        $data->save();
        return response()->json($data);
    }
}