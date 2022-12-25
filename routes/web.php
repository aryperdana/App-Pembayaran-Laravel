<?php

use App\Http\Controllers\Beranda;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JenisTagihanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KontakGuruController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TagihanSppController;
use App\Http\Controllers\TagihanLainnyaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaliMuridController;
use App\Http\Controllers\DetailTagihanSPPController;
use App\Http\Controllers\LaporanTunggakanController;
use App\Http\Controllers\LaporanArusKasController;
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
        Route::resource('jenis-tagihan', JenisTagihanController::class);
        Route::resource('tagihan-spp', TagihanSppController::class);
        Route::resource('detail-tagihan-spp', DetailTagihanSPPController::class);
        Route::get('/tagihan-spp/kelas/{id}', [TagihanSppController::class, 'kelas']);
        Route::post('/tagihan-spp/send-notif', [TagihanSppController::class, 'sendNotif']);
        Route::resource('tagihan-lainnya', TagihanLainnyaController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('pembayaran', PembayaranController::class);
        Route::post('/pembayaran/pay', [PembayaranController::class, 'pay']);
        Route::get('/pembayaran/get-tagihan/', [PembayaranController::class, 'tagihan']);
        Route::resource('laporan-tunggakan', LaporanTunggakanController::class);
        Route::resource('laporan-arus-kas', LaporanArusKasController::class);
        Route::get('/export/{start_date}/{end_date}',[LaporanTunggakanController::class,'exportTunggakan'])->name('export');
        // Route::get('/laporan-tunggakan/export/', [LaporanTunggakanController::class, 'exportTunggakan']);
    });
    Route::group(['middleware' => ['cekUserLogin:2']], function () {
        // Route::resource('wali-kelas', WaliKelas::class);
    });
});
