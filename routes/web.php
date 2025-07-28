<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\USer\OrderController as UserOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('shop.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function (){
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('users',UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
});

Route::get('orders/{order}/print',[PDFController::class, 'generatePDF'])->name('orders.print');;

Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware('auth')->post('/orders',[UserOrderController::class,'store'])->name('orders.store');
Route::middleware('auth')->get('/orders/index', [UserOrderController::class, 'index'])->name('order.index');
