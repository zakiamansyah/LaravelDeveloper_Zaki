<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CharacterMatchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::prefix('auth')->group(function () {
    Route::get('generateCsrfToken', [AuthController::class, 'generateCsrfToken']);
    Route::get('/login', [AuthController::class, 'showLoginForm']);
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('user/{id}', [AuthController::class, 'getUser']);
});

// Order Routes
Route::prefix('order')->group(function () {
    Route::get('/create', [OrderController::class, 'createOrder'])->name('order.create');
    Route::get('/getAll', [OrderController::class, 'getAllOrder'])->name('order');
    Route::get('/{id}', [OrderController::class, 'getOrderById'])->name('order.show');
    Route::post('/', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/{id}/edit', [OrderController::class, 'editOrder'])->name('order.edit');
    Route::post('/update/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/delete/{id}', [OrderController::class, 'delete'])->name('order.destroy');
});

// Category Routes
Route::prefix('category')->group(function () {
    Route::get('/create', [CategoryController::class, 'createCategory'])->name('category.create');
    Route::get('/', [CategoryController::class, 'getAllCategories'])->name('category');
    Route::get('/{id}', [CategoryController::class, 'getCategoryById'])->name('category.show');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{id}/edit', [CategoryController::class, 'editCategory'])->name('category.edit');
    Route::post('/update/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');
    Route::delete('/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');
});

// Product Routes
Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'getAllProducts'])->name('product');
    Route::get('/create', [ProductController::class, 'createProduct'])->name('products.create');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{id}', [ProductController::class, 'getProductById'])->name('products.show');
    Route::get('/edit/{id}', [ProductController::class, 'editProduct'])->name('products.edit');
    Route::post('/update/{id}', [ProductController::class, 'updateProduct'])->name('products.update');
    Route::delete('/delete/{id}', [ProductController::class, 'deleteProduct'])->name('products.delete');
});

// Character Match Routes
Route::prefix('character-match')->group(function () {
    Route::get('/', [CharacterMatchController::class, 'index'])->name('character.match');
    Route::post('/', [CharacterMatchController::class, 'calculate'])->name('character.match.calculate');
});
