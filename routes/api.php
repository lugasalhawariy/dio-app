<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
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

Route::middleware('api_key')->group(function () {
    Route::get('/users', [UserController::class, 'index']);

    //products
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{uuid}', [ProductController::class, 'show']);
    Route::delete('/products/{uuid}', [ProductController::class, 'delete']);

    //inventories
    Route::get('/inventories', [InventoryController::class, 'index']);
    Route::post('/inventories', [InventoryController::class, 'store']);
    Route::get('/inventories/{uuid}', [InventoryController::class, 'show']);

    //sales
    Route::get('/sales', [SaleController::class, 'index']);
    Route::post('/sales', [SaleController::class, 'store']);
    Route::get('/sales/{uuid}', [SaleController::class, 'show']);
    Route::patch('/sales/{uuid}', [SaleController::class, 'update']);
});

Route::post('/login', [AuthController::class, 'login']);
