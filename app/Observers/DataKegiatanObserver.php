<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\DataKegiatan;

class DataKegiatanObserver
{
    // public function saving(DataKegiatan $dataKegiatan)
    // {
    //     if(Auth::id()){
    //         $dataKegiatan->user_id = Auth::id();
    //     }
    // }


    /**
     * Handle the data kegiatan "created" event.
     *
     * @param  \App\DataKegiatan  $dataKegiatan
     * @return void
     */
    public function created(DataKegiatan $dataKegiatan)
    {
        //
        if(Auth::id()){
            $dataKegiatan->user_id = Auth::id();
        }
    }

    /**
     * Handle the data kegiatan "updated" event.
     *
     * @param  \App\DataKegiatan  $dataKegiatan
     * @return void
     */
    public function updated(DataKegiatan $dataKegiatan)
    {
        //
    }

    /**
     * Handle the data kegiatan "deleted" event.
     *
     * @param  \App\DataKegiatan  $dataKegiatan
     * @return void
     */
    public function deleted(DataKegiatan $dataKegiatan)
    {
        //
    }

    /**
     * Handle the data kegiatan "restored" event.
     *
     * @param  \App\DataKegiatan  $dataKegiatan
     * @return void
     */
    public function restored(DataKegiatan $dataKegiatan)
    {
        //
    }

    /**
     * Handle the data kegiatan "force deleted" event.
     *
     * @param  \App\DataKegiatan  $dataKegiatan
     * @return void
     */
    public function forceDeleted(DataKegiatan $dataKegiatan)
    {
        //
    }
}
