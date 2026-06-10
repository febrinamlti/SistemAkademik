<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('jurusan', JurusanController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('matakuliah', MatakuliahController::class);

    // proteksi halaman mahasiswa
Route::middleware('auth')->group(function () {

    Route::get('/mahasiswa/export-csv', [MahasiswaController::class, 'exportCsv'])
        ->name('mahasiswa.export-csv');

    Route::get('/mahasiswa/print', [MahasiswaController::class, 'print'])
        ->name('mahasiswa.print');

    Route::resource('mahasiswa', MahasiswaController::class);

    Route::get('/jurusan/export-excel', [JurusanController::class, 'exportExcel'])
    ->name('jurusan.export-excel');

    Route::get('/jurusan/print', [JurusanController::class, 'print'])
    ->name('jurusan.print');

    Route::get('/matakuliah/export-excel', [MatakuliahController::class, 'exportExcel'])
    ->name('matakuliah.export-excel');

    Route::get('/matakuliah/print', [MatakuliahController::class, 'print'])
    ->name('matakuliah.print');
});
});
