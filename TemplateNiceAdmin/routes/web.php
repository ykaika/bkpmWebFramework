<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\UploadController;


Route::get('/', function () {
    return view('index');
});

Route::group(['namespace' => 'App\Http\Controllers\Backend'], function () {
    Route::resource('dashboard', 'DashboardController');
    Route::resource('pendidikan', 'PendidikanController');
    Route::resource('pengalaman_kerja', 'PengalamanKerjaController');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Acara 17
Route::get('/session/create', [SessionController::class, 'create']);
Route::get('/session/show', [SessionController::class, 'show']);
Route::get('/session/delete', [SessionController::class, 'delete']);

Route::get('/pegawai/{nama}', [PegawaiController::class, 'index']);

Route::get('/formulir', [PegawaiController::class, 'formulir']);
Route::post('/formulir/proses', [PegawaiController::class, 'proses']);

// Acara 18
Route::get('/cobaerror/{nama?}', [CobaController::class, 'index']);

//Acara 19
Route::get('/upload', [UploadController::class, 'upload']);
Route::post('/upload/proses', [UploadController::class, 'proses_upload'])->name('upload.proses');
Route::post('/upload/resize', [UploadController::class, 'proses_upload'])->name('upload.resize');