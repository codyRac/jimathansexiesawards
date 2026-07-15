<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NominationController;
use App\Http\Controllers\XiesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [XiesController::class, 'home'])->name('home');
Route::get('shop', [XiesController::class, 'shop'])->name('shop');

Route::get('nominate', [NominationController::class, 'create'])->name('nominate');
Route::post('nominate', [NominationController::class, 'store'])->name('nominate.store');
Route::get('nominate/thank-you', [NominationController::class, 'confirmation'])->name('nominate.confirmation');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::patch('dashboard/nominations/{nomination}/status', [DashboardController::class, 'updateStatus'])->name('dashboard.nominations.status');
});

require __DIR__.'/settings.php';
