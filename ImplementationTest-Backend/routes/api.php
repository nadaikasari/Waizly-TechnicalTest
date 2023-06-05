<?php

use App\Http\Controllers\productController;
use App\Http\Controllers\UserController;
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


Route::prefix('product')->group(function () {
    Route::get('/', [productController::class, 'index']);
    Route::get('/{id}', [productController::class, 'showById']);
    Route::post('/', [productController::class, 'store']);
    Route::put('/{id}/update', [productController::class, 'update']);
    Route::delete('/{id}', [productController::class, 'delete']);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'])->name('login');
