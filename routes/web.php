<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// Ruta de inicio (home)
Route::get('/', [FrontController::class, 'index'])->name('home');

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas para platos (Dish)
    Route::resource('dishes', DishController::class);
    
    // Rutas para pedidos (Order)
    Route::resource('orders', OrderController::class);
});



// Otras rutas del front-end
Route::get('/dish/{dish}', [FrontController::class, 'show'])->name('dish.show');
Route::get('/cart', [FrontController::class, 'cart'])->name('cart');
Route::post('/order', [FrontController::class, 'storeOrder'])->name('order.store');
Route::post('/add-cart', [FrontController::class, 'updateCart'])->name('cart.add');
Route::post('/update-cart', [FrontController::class, 'updateCart'])->name('cart.update');



// Rutas de autenticación
require __DIR__.'/auth.php';