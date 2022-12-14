<?php

use App\Http\Controllers\User\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/change-status', [App\Http\Controllers\Admin\DashboardController::class, 'changeStatus'])->name('change.status');
});


Route::middleware(['auth'])->group(function () {
    Route::get('get-categories', [App\Http\Controllers\User\DashboardController::class, 'getCategories'])->name('get.categories');
    Route::get('get-products', [App\Http\Controllers\User\DashboardController::class, 'getProducts'])->name('get.products');
    Route::get('get-category-list', [App\Http\Controllers\User\DashboardController::class, 'getCategoryList'])->name('get.category.list');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/add-products', [App\Http\Controllers\User\DashboardController::class, 'addProduct'])->name('add.product');
    Route::post('/add-categories', [App\Http\Controllers\User\DashboardController::class, 'addCategory'])->name('add.category');
    Route::post('/delete-products', [App\Http\Controllers\User\DashboardController::class, 'destroyProduct'])->name('product.destroy');
    Route::post('/delete-category', [App\Http\Controllers\User\DashboardController::class, 'destroyCategory'])->name('destroy.category');
    Route::post('/update-product', [App\Http\Controllers\User\DashboardController::class, 'updateProduct'])->name('update.product');
    Route::post('/update-category', [App\Http\Controllers\User\DashboardController::class, 'updateCategory'])->name('update.category');
});

