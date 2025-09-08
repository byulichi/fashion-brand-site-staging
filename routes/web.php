<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->to(url()->previous());
})->name('logout');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/items/create', [App\Http\Controllers\ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [App\Http\Controllers\ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{id}/edit', [App\Http\Controllers\ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{id}', [App\Http\Controllers\ItemController::class, 'destroy'])->name('items.destroy');
});

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('/products/{item}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/my-purchases', [App\Http\Controllers\OrderController::class, 'index'])->name('my-purchases');

// Cart
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{itemId}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{itemId}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/add-hardcoded', [App\Http\Controllers\CartController::class, 'addHardcoded'])->name('cart.add.hardcoded');

// Checkout
Route::get('/user-checkout/', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/checkout/success', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [App\Http\Controllers\CheckoutController::class, 'cancel'])->name('checkout.cancel');
Route::post('/webhook', [App\Http\Controllers\CheckoutController::class, 'webhook'])->name('checkout.webhook');
Route::post('/pay/{orderId}', [App\Http\Controllers\CheckoutController::class, 'pay'])->name('order.pay');
Route::view('/success', 'checkout.success');
Route::view('/cancel', 'checkout.cancel');

require __DIR__ . '/auth.php';

use App\Http\Controllers\StripeController;

Route::get('/pay-test', [StripeController::class, 'payTest'])->name('pay.test');
