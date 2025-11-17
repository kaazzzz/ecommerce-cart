<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [ProductController::class, 'index'])->name('home');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/item/{itemId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/item/{itemId}', [CartController::class, 'destroy'])->name('cart.destroy');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{orderId}', [CheckoutController::class, 'success'])->name('checkout.success');

use App\Http\Controllers\ProductAdminController;

/* Admin functions inside the store */
Route::post('/products/create', [ProductAdminController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProductAdminController::class, 'edit'])->name('products.edit');
Route::post('/products/{id}/update', [ProductAdminController::class, 'update'])->name('products.update');
Route::get('/products/{id}/delete', [ProductAdminController::class, 'delete'])->name('products.delete');
