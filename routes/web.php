<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminMahasiswaController;
use App\Http\Controllers\AdminPendaftaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('administrasi/laporan', [AdminPendaftaranController::class, 'laporanAdmin'])->name('administrasi.laporan');
Route::get('administrasi/ujian', [AdminPendaftaranController::class, 'laporanUjian'])->name('ujian.laporan');
Route::get('/verifikasi-ujian-index', [AdminPendaftaranController::class, 'verifikasiUjianIndex'])
    ->name('verifikasi.ujian.index');
Route::patch('/update-verifikasi-ujian/{id}', [AdminPendaftaranController::class, 'updateVerifikasiUjian'])
    ->name('update.verifikasi.ujian');

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('adminMahasiswa', AdminMahasiswaController::class);
Route::resource('pendaftaran', PendaftaranController::class);
Route::resource('adminPendaftaran', AdminPendaftaranController::class);
Route::resource('dokumen', DokumenController::class);
Route::resource('jurusan', JurusanController::class);
