<?php

use App\Http\Controllers\AddressesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShoppingCartsController;
use App\Http\Controllers\UsersController;
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

Route::get('/', [ProductsController::class, 'home'])->name('welcome.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/products/toys', [ProductsController::class, 'toys'])->name('products.toys');
    Route::get('/products/{category}/toys', [ProductsController::class, 'categoryToys'])->name('products.categoryToys');
});

Route::get('/home', function () {
    return view('auth.dashboard');
})->middleware('auth', 'verified');

Route::resource('/products', ProductsController::class);
Route::get('/search/products', [ProductsController::class, 'search'])->name('search.products');

Route::resource('/categories', CategoriesController::class);
Route::get('/search/categories', [CategoriesController::class, 'search'])->name('search.categories');
Route::get('/categories/{category}/search', [CategoriesController::class, 'searchInCategory'])->name('search.productsInCategory');
Route::get('/categories/{category}/products', [CategoriesController::class, 'showProducts'])->name('categories.products');
Route::delete('/categories/{category}/detach/{product}', [CategoriesController::class, 'detachProduct'])->name('categories.detach');
Route::get('/categories/{category}/add-product-form', [CategoriesController::class, 'addProductForm'])->name('categories.add-product-form');
Route::post('/categories/{category}/add-product', [CategoriesController::class, 'addProduct'])->name('categories.add-product');

Route::resource('/orders', OrdersController::class);
Route::get('users/{user_id}/orders', [OrdersController::class, 'ordersByUser'])->name('orders.by_user');
Route::post('orders/update-status', [OrdersController::class, 'updateStatus'])->name('orders.update_status');

Route::post('/cart/add', [ShoppingCartsController::class, 'addProduct'])->name('cart.add')->middleware('auth');

Route::get('/cart', [ShoppingCartsController::class, 'show_products'])->name('carts.show_products');
Route::post('/cart/increment', [ShoppingCartsController::class, 'incrementProduct'])->name('cart.increment');
Route::post('/cart/decrement', [ShoppingCartsController::class, 'decreaseProduct'])->name('cart.decrement');
Route::post('/cart/update', [ShoppingCartsController::class, 'updateQuantityProduct'])->name('cart.update');

Route::post('/cart/delete',[ShoppingCartsController::class, 'deleteProductCart'])->name('cart.delete');

Route::get('/cart/checkout', [ShoppingCartsController::class, 'checkout'])->name('cart.checkout');

Route::post('/comprar', [OrdersController::class, 'buy'])->name('order.buy');

Route::get('/products_clients/show/{productId}',[ProductsController::class, 'show_client'])->name('products_clients.show');

Route::post('/cart/delete', [ShoppingCartsController::class, 'deleteProductCart'])->name('cart.delete');

Route::middleware(['auth'])->group(function () {
    Route::get('/clients/profile', [UsersController::class, 'profile'])->name('clients.profile');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('/addresses', AddressesController::class);
});
Route::get('/likeProduct',[UsersController::class,"likeorUnlikeProduct"])->name('user.like');




