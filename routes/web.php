<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('/my-purchases', [App\Http\Controllers\OrderController::class, 'index'])->name('my-purchases');

// Cart
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{itemId}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{itemId}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
Route::get('/checkout/success', [App\Http\Controllers\CartController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [App\Http\Controllers\CartController::class, 'cancel'])->name('checkout.cancel');
Route::post('/webhook', [App\Http\Controllers\CartController::class, 'webhook'])->name('checkout.webhook');
Route::post('/pay/{orderId}', [App\Http\Controllers\CartController::class, 'pay'])->name('order.pay');


require __DIR__.'/auth.php';
