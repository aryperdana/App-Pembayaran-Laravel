<?php

use App\Http\Controllers\Beranda;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KontakGuruController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaliKelas;
use App\Http\Controllers\WaliMuridController;
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

Route::get('/', [LayoutController::class, 'index'])->name('layout')->middleware('auth');
Route::get('/home', [LayoutController::class, 'index'])->name('layout')->middleware('auth');


Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login/proses', 'proses');
    Route::get('logout', 'logout');
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cekUserLogin:1']], function () {
        Route::resource('beranda', Beranda::class);
        Route::resource('kontak-guru', KontakGuruController::class);
        Route::resource('user', UserController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('guru', GuruController::class);
        Route::resource('wali-murid', WaliMuridController::class);
    });
    Route::group(['middleware' => ['cekUserLogin:2']], function () {
        Route::resource('wali-kelas', WaliKelas::class);
    });
});
