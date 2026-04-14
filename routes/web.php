<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaptopController4;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';


// Route hiển thị trang quản lý
Route::get('/admin', [LaptopController4::class, 'indexAdmin'])->name('admin.index');

// Route xử lý xóa mềm
Route::patch('/admin/laptop/delete/{id}', [LaptopController4::class, 'softDelete'])->name('admin.laptop.softDelete');