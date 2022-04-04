<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\KategoriController;
use App\Http\Controllers\Backend\PemeriksaanController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\PenyakitController;
use App\Http\Controllers\Backend\UserController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return redirect('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('pemeriksaan', PemeriksaanController::class);

    Route::group(['middleware' => ['role:Admin']], function() {
        Route::name('penyakit.')->group(function ()
        {
            Route::resource('/kategori', KategoriController::class)->except(['show', 'create']);
            Route::resource('/daftar-penyakit', PenyakitController::class)->except('show');
        });

        Route::resource('user', UserController::class)->only(['index', 'update', 'destroy']);
        Route::put('petugas-lab/{user}', [UserController::class, 'petugas_lab'])->name('user.petugas');
    });
});

require __DIR__.'/auth.php';
