<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/products', function () {
    return view('products');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/giohang', [CartController::class, 'index'])->name('giohang'); // ✅ giữ lại 1 cái thôi
Route::post('/giohang/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/giohang/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/giohang/checkout', [CartController::class, 'checkout'])->name('cart.checkout');



require __DIR__.'/auth.php';
