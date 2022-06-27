<?php

namespace App\Imports;

use App\Pelanggan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

function IsNullOrEmptyString($str){
    return (isset($str) || trim($str) !== '');
}

class PelangganImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (IsNullOrEmptyString($row['id_pelanggan'])) {
            return new Pelanggan([
                //
                'berkas' => $row['berkas'],
                'nomor_box' => $row['nomor_box'],
                'nomor_urut' => $row['nomor_urut'],
                'id_pelanggan' => $row['id_pelanggan'],
                'nama' => $row['name'],
                'alamat' => $row['address'],
                'tarif_daya' => $row['tarif'].'/'.$row['daya'],
                'nomor_meter' => $row['no_meter'],
                'merk_meter' => $row['merk_meter'],
                'type_meter' => $row['type_meter'],
                'nomor_modem' => $row['no_comm_device'],
                'merk_modem' => $row['merk_comm_device'],
                'type_modem' => $row['type_comm_device'],
                'gsm' => $row['no_sim'],
                'provider' => $row['provider'],
                // 'bulk_stage' => $row[12],
            ]);
        }
    }
}
