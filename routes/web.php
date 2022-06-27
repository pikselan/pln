<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/', '/admin');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::post('/admin/pelanggans/import_excel', 'PelangganController@import_excel')->middleware('admin.user');

// Route::get('/admin/export', 'DataKegiatanController@index');
Route::get('/admin/export/datakegiatan/excel/{from}/{to}', 'DataKegiatanController@export_excel')->middleware('admin.user');
Route::get('/admin/export/datakegiatan/pdf/{from}/{to}', 'DataKegiatanController@export_pdf')->middleware('admin.user');
Route::get('/admin/data-kegiatans/{id}/excel', 'DataKegiatanController@export_single_excel')->middleware('admin.user');
Route::get('/admin/data-kegiatans/{id}/pdf', 'DataKegiatanController@export_single_pdf')->middleware('admin.user');

Route::get('/admin/export/pelanggans/excel', 'PelangganController@export_pelanggan')->middleware('admin.user');