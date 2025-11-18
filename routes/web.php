<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminAuthController;

Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AdminAuthController::class, 'login']);
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

Route::middleware('admin')->group(function() {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/{product:slug}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{product:slug}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{product:slug}', [ProductController::class, 'destroy'])->name('products.destroy');
});


