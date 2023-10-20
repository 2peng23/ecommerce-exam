<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        redirect('dashboard');
    }
    $data = Product::all();
    // $cartCount = null;
    return view('welcome', compact('data'));
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


    Route::middleware('admin')->group(function () {
        Route::get('delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('delete-product');
        Route::get('edit-product/{id}', [ProductController::class, 'editProduct'])->name('edit-product');
        Route::post('update-product/{id}', [ProductController::class, 'updateProduct'])->name('update-product');
        Route::get('all-products', [ProductController::class, 'allProducts'])->name('all-products');
        Route::get('all-cart', [ProductController::class, 'allCart'])->name('all-cart');
        Route::post('save-product', [ProductController::class, 'saveProduct'])->name('save-product');
    });

    Route::middleware('user')->group(function () {
        Route::post('add-cart/{id}', [ProductController::class, 'addCart'])->name('add-cart');
        Route::get('view-cart/{id}', [ProductController::class, 'viewCart'])->name('view-cart');
        Route::post('update-cart/{id}', [ProductController::class, 'updateCart'])->name('update-cart');
        Route::get('get-total-price', [ProductController::class, 'getTotalPrice'])->name('get-total-price');
        Route::get('delete-cart-item/{id}', [ProductController::class, 'deleteCartItem'])->name('delete-cart-item');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
