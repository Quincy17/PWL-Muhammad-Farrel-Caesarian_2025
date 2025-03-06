<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;

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


Route::get('/', [HomeController::class, 'index']);

//Route Prefix
Route::prefix('category')->group(function () {
    Route::get('/{category}', [ProductsController::class, 'showCategory']);
});

Route::get('/user/{id}/name/{name}', [UserController::class, 'showProfile']);

Route::get('/sales', [SalesController::class, 'index']);

