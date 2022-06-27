<?php

namespace App\Exports;

use App\DataKegiatan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataKegiatanExcelExport implements FromView
{
    protected $data;

    function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('exportexcelall', [
            'data' => $this->data
        ]);
    }
}