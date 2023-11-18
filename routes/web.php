<?php

use App\Http\Controllers\AdminAbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminJabatanController;
use App\Http\Controllers\AdminPegawaiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiAbsensiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SettingsController;
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

// AUTHENTICATION LAYER
Route::get('/', [AuthController::class, 'index']);
Route::get('/install', [AuthController::class, 'install']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/install', [AuthController::class, 'install_']);
Route::get('/logout', [AuthController::class, 'logout']);

// ADMIN LAYER
Route::get('/admin', [AdminController::class, 'index'])->middleware('is_admin');
Route::get('/admin/profile', [AdminController::class, 'profile'])->middleware('is_admin');
Route::post('/admin/profile_', [AdminController::class, 'profile_'])->middleware('is_admin');
Route::post('/admin/password', [AdminController::class, 'password'])->middleware('is_admin');

// Admin-Pegawai
Route::resource('/admin/pegawai', AdminPegawaiController::class)->middleware('is_admin');
Route::post('/admin/excel_pegawai', [AdminPegawaiController::class, 'excel_pegawai'])->middleware('is_admin');
Route::post('/admin/edit_pegawai', [AdminPegawaiController::class, 'edit_pegawai']);
// Admin-Jabatan
Route::resource('/admin/jabatan', AdminJabatanController::class)->middleware('is_admin');
// Admin-Settings
Route::resource('/admin/settings', SettingsController::class)->middleware('is_admin');
// Admin-absensi
Route::resource('/admin/absensi', AdminAbsensiController::class)->middleware('is_admin');
Route::get('/admin/absen/tambah', [AdminAbsensiController::class, 'tambah'])->middleware('is_admin');
Route::get('/admin/absen_pegawai/{kode_absensi}/{pegawai_id}', [AdminAbsensiController::class, 'absen_pegawai'])->middleware('is_admin');
Route::get('/admin/izin_pegawai/{kode_absensi}/{pegawai_id}', [AdminAbsensiController::class, 'izin_pegawai'])->middleware('is_admin');
Route::get('/admin/izinkan/{kode_absensi}/{pegawai_id}', [AdminAbsensiController::class, 'izinkan'])->middleware('is_admin');
Route::get('/admin/download_izin/{file}', [AdminAbsensiController::class, 'download_izin'])->middleware('is_admin');

// PEGAWAI LAYER
Route::get('/pegawai', [PegawaiController::class, 'index'])->middleware('is_pegawai');
Route::get('/pegawai/profile', [PegawaiController::class, 'profile'])->middleware('is_pegawai');
Route::post('/pegawai/edit_profile', [PegawaiController::class, 'edit_profile'])->middleware('is_pegawai');
Route::post('/pegawai/password', [PegawaiController::class, 'password'])->middleware('is_pegawai');
Route::resource('/pegawai/absensi', PegawaiAbsensiController::class)->middleware('is_pegawai');
Route::post('/pegawai/absensi_masuk', [PegawaiAbsensiController::class, 'absensi_masuk'])->middleware('is_pegawai');
Route::post('/pegawai/absensi_pulang', [PegawaiAbsensiController::class, 'absensi_pulang'])->middleware('is_pegawai');
Route::get('/pegawai/izin_absensi/{absensi:kode_absensi}', [PegawaiAbsensiController::class, 'izin'])->middleware('is_pegawai');
Route::post('/pegawai/izin', [PegawaiAbsensiController::class, '_izin'])->middleware('is_pegawai');
Route::get('/pegawai/download_izin/{file}', [PegawaiAbsensiController::class, 'download_izin'])->middleware('is_pegawai');
