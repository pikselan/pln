<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Pelanggan;
use App\Exports\PelangganExport;

use Session;

use App\Imports\PelangganImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class PelangganController extends Controller
{
	public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:xlsx'
		]);

		// menangkap file excel
		$file = $request->file('file');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();

		// upload ke folder file_pelanggan di dalam folder public
		$file->move('file_pelanggan',$nama_file);

		// import data
		Excel::import(new pelangganImport, public_path('/file_pelanggan/'.$nama_file));

		// notifikasi dengan session
		Session::flash('sukses','Data Pelanggan Berhasil Diimport!');

		// alihkan halaman kembali
		return redirect('/admin/pelanggans');
	}
  
	public function export_pelanggan()
	{
			// $data = Pelanggan::all();
			$data = Pelanggan::whereIn('id', array(DB::raw('SELECT MAX(b.id) FROM pelanggans b GROUP BY b.nama,b.id_pelanggan')))->get();
			return Excel::download(new PelangganExport($data), 'rekap_semua_data_pelanggan.xlsx');
	}
	
	public function select($id)
	{
	// 		$pelanggan = Pelanggan::firstWhere('id_pelanggan', $id);
				$pelanggan = Pelanggan::select('id','id_pelanggan','nama','tarif_daya','alamat','nomor_meter','merk_meter','type_meter','gsm','provider','nomor_modem','merk_modem','type_modem','berkas','nomor_box','nomor_urut')->where('id_pelanggan', $id)->latest()->first();
				return response()->json($pelanggan);
	}
}