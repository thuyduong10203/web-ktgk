<?php

use App\Http\Controllers\LaptopController2;
use Illuminate\Support\Facades\Route;

Route::get('/', [LaptopController2::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
