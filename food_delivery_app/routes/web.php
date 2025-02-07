<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\OrderManager;
use App\Http\Controllers\ProductManager;
use App\Http\Middleware\AdminRole;
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
    return 'Welcome, Order your Delicious Meal';
});


Route::get("login", [AuthManager::class, "login"])->name("login");
Route::get("logout", [AuthManager::class, "logout"])->name("logout");
Route::post("login", [AuthManager::class, "loginPost"])->name("login.post");

Route::prefix("admin")->middleware(AdminRole::class)->group(function () {
    Route::get('dashboard', [OrderManager::class, "newOrders"])->name('dashboard');
    Route::get('products', [ProductManager::class, "listProducts"])->name("products");
    Route::post('products', [ProductManager::class, "addProducts"])->name("product.add");
    Route::get('product/delete', [ProductManager::class, "deleteProducts"])->name("product.delete");
    Route::post('order/assign', [OrderManager::class, "assignOrder"])->name("order.assign");
    Route::get('order/list', [OrderManager::class, "listOrders"])->name("order.list");
});