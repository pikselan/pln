<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class DataKegiatan extends Model
{
  protected $table = "data_kegiatans";
  
  protected $fillable = ['kegiatan_id','data_sesudah','no_ba','pelanggan_id','koordinat','kondisi_box','kondisi_meter','shuntrip','pembatas','merek_pembatas','arus_pembatas','ratio_ct','cosphi','tegangan_r','tegangan_s','tegangan_t','arus_r','arus_s','arus_t','wbp','lwbp1','lwbp2','total','kvarh','pintu_luar_atas','pintu_luar_bawah','terminal_kwh','modem','peruntukan','kesimpulan','foto_kwh','foto_mcb','foto_box_app','foto_modem','foto_ba','foto_bangunan','foto_1','foto_2','user_id','nomor_modem_baru','merk_modem_baru','type_modem_baru','gsm_baru','provider_baru','telepon_pelanggan','data_box','id_pelanggan','nama','alamat','nomor_meter','merk_meter','type_meter','gsm','provider','nomor_modem','merk_modem','type_modem','tarif_daya','data_box','nomor_box','nomor_urut','segel_lama','segel_baru'];
  
  public function kegiatan()
  {
      return $this->belongsTo('App\Kegiatan');
  }

  public function pelanggan()
  {
      return $this->belongsTo('App\Pelanggan');
  }

  public function user()
  {
      return $this->belongsTo('App\User');
  }
}
