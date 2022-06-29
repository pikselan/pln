<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Pelanggan;

class DataboxController extends Controller
{
	public function index(Request $request) 
	{
        $mode = $request->input('inpMode');

        if($mode == 'search') {
            $id_pelanggan = $request->input('inpSearch');
            $data = Pelanggan::where('id_pelanggan', $id_pelanggan)->latest()->first();
            
            if($data === null) {
                Session::flash('mencari','ID pelanggan tidak ada.');
                $result = 'warning';
            } else {
                Session::flash('mencari','ID pelanggan ditemukan.');
                $result = 'success';
            }

            return view('databox', ['data' => $data, 'keyword' => $id_pelanggan, 'result' => $result]);
        } elseif($mode == 'databox') {
            $id = $request->input('inpId');
            $nomor_box = $request->input('inpNomorBox');
            $nomor_urut = $request->input('inpNomorUrut');

            $values=array('nomor_box'=>$nomor_box,'nomor_urut'=>$nomor_urut);
            Pelanggan::where('id',$id)->update($values);

            Session::flash('sukses','Data box berhasil diupdate.');

            return view('databox');
        } else {
            return view('databox');
        }
	}
    
}
