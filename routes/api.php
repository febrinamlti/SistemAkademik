<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaApi;
use App\Http\Controllers\JAuthController;

Route::apiResource('mahasiswa', MahasiswaApi::class);
