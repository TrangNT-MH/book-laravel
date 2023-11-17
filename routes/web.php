<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
//use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProductController;
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

//Route::get('/admin/dashboard', function () {
//    return view('layout.master');
//});
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::prefix('/book')->group(function () {
        Route::get('/index', [BookController::class, 'index'])->name('admin.book.index');
        Route::get('/store', [BookController::class, 'create'])->name('admin.book.create');
        Route::post('/store', [BookController::class, 'store'])->name('admin.book.store');
        Route::get('/edit/{id}', [BookController::class, 'edit'])->name('admin.book.edit');
        Route::put('/edit/{id}', [BookController::class, 'update'])->name('admin.book.update');
    });
   Route::get('/index', [UserController::class, 'index'])->name('admin.index');
   Route::get('/detail/{id}', [UserController::class, 'detail'])->name('admin.detail');
   Route::get('/search', [UserController::class, 'search'])->name('admin.search');
});
Route::prefix('user')->group(function () {
//    Route::get('/index', [UserController::class, 'index']);
});
