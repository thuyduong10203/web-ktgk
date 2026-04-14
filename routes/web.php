<?php

use App\Http\Controllers\LaptopController1;
use App\Http\Controllers\LaptopController4;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaptopController3;

Route::get('/', [LaptopController1::class, 'index'])->name('home');
Route::get('/laptop', [LaptopController1::class, 'index']);
Route::get('/laptop/theloai/{id}', [LaptopController1::class, 'theloai'])->name('laptop.theloai');
Route::get('/storage-image/{filename}', [LaptopController1::class, 'image'])
    ->where('filename', '.*')
    ->name('storage.image');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Route hiển thị trang quản lý
Route::get('/admin', [LaptopController4::class, 'indexAdmin'])->name('admin.index');

// Route xử lý xóa mềm
Route::patch('/admin/laptop/delete/{id}', [LaptopController4::class, 'softDelete'])->name('admin.laptop.softDelete');

Route::post('/dat-hang', [LaptopController4::class, 'datHang'])
    ->middleware('auth')
    ->name('datHang');
Route::get('/testemail','App\Http\Controllers\LaptopController4@testemail');


// Câu 3
Route::get('/laptop/chitiet/{id}', [LaptopController3::class, 'chitiet'])->name('laptop.chitiet');

// Câu 4
Route::get('/gio-hang', [LaptopController3::class, 'order'])->name('cart');
Route::post('/cartadd', [LaptopController3::class, 'cartadd'])->name('cartadd');
Route::delete('/cartdelete', [LaptopController3::class, 'cartdelete'])->name('cartdelete');
Route::post('/ordercreate', [LaptopController3::class, 'ordercreate'])
    ->middleware('auth')
    ->name('ordercreate');
