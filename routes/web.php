<?php

use App\Http\Controllers\LaptopController2;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaptopController3;

Route::get('/', [LaptopController2::class, 'index']);
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// Câu 3
Route::get('/laptop/chitiet/{id}', [LaptopController3::class, 'detail'])->name('laptop.detail');
// Câu 4
Route::post('/cart/add', [LaptopController3::class, 'addToCart'])->name('cart.add');
Route::get('/gio-hang', [LaptopController3::class, 'viewCart'])->name('cart.view');
Route::get('/cart/remove/{id}', [LaptopController3::class, 'removeCart'])->name('cart.remove');
Route::post('/checkout', [LaptopController3::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/update', [LaptopController3::class, 'updateCart'])->name('cart.update');