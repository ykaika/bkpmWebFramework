<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Backend\ApiPendidikanController;
use Illuminate\Http\Request;
use App\Http\Middleware\CorsMiddleware;

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
Route::get('/upload', [UploadController::class, 'upload'])->name('upload');
Route::post('/upload/proses', [UploadController::class, 'proses_upload'])->name('upload.proses');
Route::post('/upload/resize', [UploadController::class, 'resize_upload'])->name('upload.resize');

//Acara 20
Route::get('/dropzone', [UploadController::class, 'dropzone'])->name('dropzone');
Route::post('/dropzone/store', [UploadController::class, 'dropzone_store'])->name('dropzone.store');

Route::get('/pdf_upload', [UploadController::class, 'pdf_upload'])->name('pdf.upload');
Route::post('/pdf/store', [UploadController::class, 'pdf_store'])->name('pdf.store');

//Acara 21
Route::middleware('auth:api')->get('/pendidikan', function (Request $request) {
    return $request->user(); // User yang sedang login
});

Route::middleware([CorsMiddleware::class])->group(function () {
    Route::get('/pendidikan', [ApiPendidikanController::class, 'getAll']);
});

//Acara 22
Route::group(['prefix' => 'api'], function () {
    Route::get('api_pendidikan', [ApiPendidikanController::class, 'getAll']);
    Route::get('api_pendidikan/{id}', [ApiPendidikanController::class, 'getPen']);
    Route::post('api_pendidikan', [ApiPendidikanController::class, 'createPen']);
    Route::put('api_pendidikan/{id}', [ApiPendidikanController::class, 'updatePen']);
    Route::delete('api_pendidikan/{id}', [ApiPendidikanController::class, 'deletePen']);
});
