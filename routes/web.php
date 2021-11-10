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

Route::get('/', function () {
    return view('home.login.index');
});
Route::get('coba', function () {
    return view('welcome');
});

Route::get('register',['as' => 'user.register', 'uses' => 'Backend\Auth\AuthController@register']);
Route::get('login',['as' => 'user.login', 'uses' => 'Backend\Auth\AuthController@login']);
Route::post('register', ['as' => 'user.registerAuth', 'uses' => 'Backend\Auth\AuthController@registerAuth']);
Route::post('login',['as' => 'user.loginAuth', 'uses' => 'Backend\Auth\AuthController@loginAuth']);
Route::get('logout',['as' => 'user.logout', 'uses' => 'Backend\Auth\AuthController@logout']);

Route::get('dashboard/admin',['as' => 'dashboard.admin', 'uses' => 'Backend\Admin\Dashboard\DashboardController@index']);
Route::get('dashboard/admin/absensi',['as' => 'dashboard.admin.absensi', 'uses' => 'Backend\Admin\Absensi\AbsensiController@index']);
Route::post('dashboard/admin/absensi/approve',['as' => 'dashboard.admin.absensi.approve', 'uses' => 'Backend\Admin\Absensi\AbsensiController@approve']);
Route::post('dashboard/admin/absensi/tolak',['as' => 'dashboard.admin.absensi.tolak', 'uses' => 'Backend\Admin\Absensi\AbsensiController@tolak']);

Route::get('dashboard/absensi',['as' => 'dashboard.absensi', 'uses' => 'Backend\Karyawan\Absensi\AbsensiController@index']);
Route::get('dashboard/absensi/absen',['as' => 'dashboard.absensi.absen', 'uses' => 'Backend\Karyawan\Absensi\AbsensiController@absen']);
Route::get('dashboard/absensi/masuk',['as' => 'dashboard.absensi.masuk', 'uses' => 'Backend\Karyawan\Absensi\AbsensiController@masuk']);
Route::get('dashboard/absensi/keluar',['as' => 'dashboard.absensi.keluar', 'uses' => 'Backend\Karyawan\Absensi\AbsensiController@keluar']);
Route::post('dashboard/absensi/izin',['as' => 'dashboard.absensi.izin', 'uses' => 'Backend\Karyawan\Absensi\AbsensiController@izin']);
