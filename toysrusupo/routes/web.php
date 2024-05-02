<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
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
})->name('welcome.index');
Route::get('/home', function () {
    return view('auth.dashboard');
})->middleware('auth','verified');
Route::resource('/products', ProductsController::class);
Route::get('/search/products', [ProductsController::class, 'search'])->name('search.products');
Route::resource('/orders', OrdersController::class);
Route::get('users/{user_id}/orders', [OrdersController::class, 'ordersByUser'])->name('orders.by_user');
Route::post('orders/update-status', [OrdersController::class, 'updateStatus'])->name('orders.update_status');
