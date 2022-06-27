<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Kegiatan extends Model
{
  protected $table = "kegiatans";
  
  protected $fillable = ['jenis'];

  
  public function data_kegiatan()
  {
      return $this->hasMany('App\Models\DataKegiatan');
  }
}
