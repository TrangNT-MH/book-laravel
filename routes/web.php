<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

//use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\User\BookController as UserBookController;
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
Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');
Route::post('/login', [LoginRegisterController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::prefix('/book')->group(function () {
            Route::get('/index', [AdminBookController::class, 'index'])
                ->name('admin.book.index')->middleware('can:viewAny, book');
            Route::get('/store', [AdminBookController::class, 'create'])
                ->name('admin.book.create')->middleware('can:create, book');
            Route::post('/store', [AdminBookController::class, 'store'])
                ->name('admin.book.store')->middleware('can:create, book');
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

Route::get('/', [UserBookController::class, 'index'])->name('user.book.index');
Route::middleware(['auth', 'roles:user'])->group(function () {
    Route::prefix('/user')->group(function () {
    });
});

