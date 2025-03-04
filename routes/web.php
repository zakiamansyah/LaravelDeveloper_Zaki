<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CharacterMatchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });

Route::get('generateCsrfToken', [AuthController::class, 'generateCsrfToken']);
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('register', [AuthController::class, 'register']);

Route::get('user/{id}', [AuthController::class, 'getUser']);

Route::get('order/createOrder', [OrderController::class, 'createOrder'])->name('order.createOrder');

Route::get('order/getAll', [OrderController::class, 'getAllOrder'])->name('order');
Route::get('order/{id}', [OrderController::class, 'getOrderById'])->name('order.show');
Route::post('order', [OrderController::class, 'store'])->name('orders.store');
Route::get('order/editOrder', [OrderController::class, 'editOrder'])->name('order.edit');
Route::post('order/update/{id}', [OrderController::class, 'update']);
Route::delete('order/delete/{id}', [OrderController::class, 'delete'])->name('order.destroy');

Route::get('category/getAll', [CategoryController::class, 'getAllCategories'])->name('category');
Route::get('category/{id}', [CategoryController::class, 'getCategoryById']);
Route::post('category/create', [CategoryController::class, 'createCategory']);
Route::post('category/update/{id}', [CategoryController::class, 'updateCategory']);
Route::delete('category/delete/{id}', [CategoryController::class, 'deleteCategory']);

Route::get('product/create', [ProductController::class, 'createProduct'])->name('products.create');
Route::get('product/getAll', [ProductController::class, 'getAllProducts'])->name('product');
Route::get('product/{id}', [ProductController::class, 'getProductById']);
Route::post('product', [ProductController::class, 'store']);
Route::post('product/update/{id}', [ProductController::class, 'updateProduct']);
Route::delete('product/delete/{id}', [ProductController::class, 'deleteProduct']);

Route::get('/character-match', [CharacterMatchController::class, 'index'])->name('character.match');
Route::post('/character-match', [CharacterMatchController::class, 'calculate'])->name('character.match.calculate');