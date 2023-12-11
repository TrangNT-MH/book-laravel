<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\CartController;
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

Route::get('/register', [LoginRegisterController::class, 'register'])->name('register');
Route::post('/store', [LoginRegisterController::class, 'store'])->name('store');
Route::get('/', [LoginRegisterController::class, 'login'])->name('login');
Route::post('/login', [LoginRegisterController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['role:admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::prefix('/book')->group(function () {
            Route::get('/index', [AdminBookController::class, 'index'])->name('admin.book.index');
            Route::get('/store', [AdminBookController::class, 'create'])->name('admin.book.create');
            Route::post('/store', [AdminBookController::class, 'store'])->name('admin.book.store');
            Route::post('/index', [AdminBookController::class, 'index']);
            Route::get('/detail/{id}', [AdminBookController::class, 'detail'])->name('admin.book.detail');
            Route::put('/detail/{id}', [AdminBookController::class, 'edit'])->name('admin.book.edit');
            Route::put('/update-status/{id}/{status}', [AdminBookController::class, 'updateStatus'])->name('admin.book.status');
        });
        Route::get('/index', [UserController::class, 'index'])->name('admin.index');
        Route::get('/detail/{id}', [UserController::class, 'detail'])->name('admin.detail');
        Route::get('/search', [UserController::class, 'search'])->name('admin.search');
    });
});


Route::group(['middleware' => ['role:user|admin']], function () {
    Route::get('/book', [UserBookController::class, 'index'])->name('user.book.index');
    Route::get('/book/{id}', [UserBookController::class, 'addToCart'])->name('user.book.addToCart');
    Route::get('/book/detail/{id}', [UserBookController::class, 'detail'])->name('user.book.detail');
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart');
    Route::delete('/cart/delete/${id}', [CartController::class, 'delete'])->name('user.cart.delete');
});

