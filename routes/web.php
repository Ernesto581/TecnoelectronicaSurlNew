<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

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

/*
 * Public store (read-only catalog).
 * These routes do not require authentication.
 */
Route::get('/tienda', [StoreController::class, 'index'])->name('store.index');
Route::get('/tienda/producto/{product}', [StoreController::class, 'show'])->name('store.product.show');
Route::get('/tienda/categoria/{category}', [StoreController::class, 'category'])->name('store.category.show');

/*
 * Admin product management.
 * All routes require authentication AND the admin role.
 */
Route::middleware(['auth', 'admin'])->prefix('admin/productos')->name('admin.products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/crear', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
    Route::get('/{product}/editar', [ProductController::class, 'edit'])->name('edit');
    Route::patch('/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/restaurar', [ProductController::class, 'restore'])->name('restore');
});

require __DIR__.'/auth.php';
