<?php

namespace App\Exports;

use App\Pelanggan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PelangganExport implements FromView
{
    protected $data;

    function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('exportpelanggan', [
            'data' => $this->data
        ]);
    }
}