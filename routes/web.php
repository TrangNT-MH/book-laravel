<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->group(function () {
   Route::get('/index', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.index');
   Route::get('/detail/{id}', [\App\Http\Controllers\Admin\UserController::class, 'detail'])->name('admin.detail');
   Route::get('/search', [\App\Http\Controllers\Admin\UserController::class, 'search'])->name('admin.search');
   Route::get('/product', [ProductController::class, 'index']);
});
Route::prefix('user')->group(function () {
    Route::get('/index', [\App\Http\Controllers\User\UserController::class, 'index']);
});
