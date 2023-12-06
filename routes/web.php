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

Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

Route::group(['middleware' => ['role:admin']], function (){
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
});

