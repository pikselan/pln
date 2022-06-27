<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::redirect('/', '/admin');
Route::redirect('/auth', '/admin');

Route::group([
    'prefix' => 'auth',
    'middleware' => ['cors','json.response']
], function () {
    Route::get('kegiatan', 'KegiatanController@index');
    Route::post('login', 'AuthController@login');
    // Route::post('signup', 'AuthController@signup');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');

        Route::get('datasummary', 'DataKegiatanController@select_summary');
        Route::get('datakegiatan', 'DataKegiatanController@select');
        Route::post('datakegiatan', 'DataKegiatanController@create');
        Route::get('pelanggan/{id}', 'PelangganController@select');
    });
});