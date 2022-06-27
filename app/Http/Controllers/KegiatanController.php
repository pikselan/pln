<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        // $kegiatan = Kegiatan::all('id','jenis');
        $kegiatan = Kegiatan::select('id','jenis')->orderBy('created_at', 'desc')->get();
        return response()->json($kegiatan);
    }
}