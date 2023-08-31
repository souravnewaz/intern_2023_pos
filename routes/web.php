<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomerController;

Route::middleware('guest')->group(function(){
    Route::get('login', [LoginController::class, 'show']);
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('register', [RegisterController::class, 'show']);
    Route::post('register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/carts/add/{product_id}', [SaleController::class, 'addToCart'])->name('add_to_cart');
    Route::get('/carts/delete/{sale_item_id}', [SaleController::class, 'deleteFromCart'])->name('delete_from_cart');
    Route::get('/carts/update/{sale_item_id}', [SaleController::class, 'updateCart'])->name('update_cart');
    Route::post('checkout/{sale_id}', [SaleController::class, 'checkout'])->name('chekout');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
});


