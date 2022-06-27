<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pelanggan extends Model
{
    protected $table = "pelanggans";

    protected $fillable = ['id_pelanggan','nama','alamat','nomor_meter','merk_meter','type_meter','gsm','provider','nomor_modem','merk_modem','type_modem','bulk_stage','tarif_daya','berkas','nomor_box','nomor_urut'];

    public function data_kegiatan()
    {
        return $this->hasMany('App\Models\DataKegiatan');
    }

    
    public function scopeDataTerbaru($query)
    {
        return $query->whereIn('id', array(DB::raw('SELECT MAX(b.id) FROM pelanggans b GROUP BY b.id_pelanggan')));
        // return $query->whereIn('id', array(DB::raw('SELECT MAX(b.id) FROM pelanggans b GROUP BY b.nama,b.id_pelanggan')));
    }
}
