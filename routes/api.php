<?php

use App\Http\Controllers\API\Admin\BookController;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\Auth\LoginRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/admin', function (Request $request) {
    return $request->user();
});

Route::middleware(['api'])->group(function () {
    Route::post('/login', [LoginRegisterController::class, 'login']);
    Route::post('/register', [LoginRegisterController::class, 'register']);
    Route::post('/logout', [LoginRegisterController::class, 'logout']);
    Route::post('/profile', [LoginRegisterController::class, 'profile']);

    Route::prefix('/admin')->group(function () {
        Route::get('/user', [UserController::class, 'index']);
        Route::prefix('/book')->group(function () {
            Route::get('/', [BookController::class, 'index']);
            Route::get('/store', [BookController::class, 'create']);
            Route::post('/store', [BookController::class, 'store']);
//            Route::post('/index', [BookController::class, 'index']);
            Route::get('/detail/{id}', [BookController::class, 'detail']);
            Route::put('/detail/{id}', [BookController::class, 'edit']);
//            Route::put('/update-status/{id}/{status}', [BookController::class, 'updateStatus']);
        });

    });
});
