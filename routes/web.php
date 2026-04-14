<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaptopController1;
use Illuminate\Support\Facades\Route;

Route::get('/', [LaptopController1::class, 'index']);
Route::get('/laptop/theloai/{id}', [LaptopController1::class, 'theloai'])->name('laptop.theloai');
Route::get('/storage-image/{filename}', [LaptopController1::class, 'image'])
    ->where('filename', '.*')
    ->name('storage.image');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
