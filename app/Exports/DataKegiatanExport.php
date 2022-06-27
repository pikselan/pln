<?php

namespace App\Exports;

use App\DataKegiatan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataKegiatanExport implements FromView
{
    protected $data;

    function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('exportexcel', [
            'data' => $this->data
        ]);
    }
}