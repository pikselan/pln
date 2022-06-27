<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

use Illuminate\Support\Facades\Schema;
use App\Observers\DataKegiatanObserver;
use App\DataKegiatan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        
        DataKegiatan::observe(DataKegiatanObserver::class);
        
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        // date_default_timezone_set('Asia/Jakarta');
    }
}
