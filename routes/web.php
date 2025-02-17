<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dishes routes
    Route::resource('dishes', DishController::class);
    
    // Orders routes
    Route::resource('orders', OrderController::class);
});

require __DIR__.'/auth.php';
