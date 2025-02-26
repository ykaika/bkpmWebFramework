<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/service-detail', fn() => view('pages.service-details'))->name('service.detail');
Route::get('/portofolio-detail', fn() => view('pages.portofolio-details'))->name('portofolio.detail');