<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataTrainingController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\RiwayatController;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Data Training Routes
    Route::resource('data-training', DataTrainingController::class);
    
    // Prediksi Routes
    Route::get('/prediksi/create', [PrediksiController::class, 'create'])->name('prediksi.create');
    Route::post('/prediksi', [PrediksiController::class, 'store'])->name('prediksi.store');

    // Riwayat Prediksi Routes
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/{riwayat}', [RiwayatController::class, 'show'])->name('riwayat.show');
    Route::delete('/riwayat/{riwayat}', [RiwayatController::class, 'destroy'])->name('riwayat.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



