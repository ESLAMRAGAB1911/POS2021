<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\client\OrderController;
use App\Http\Controllers\MainOrderController;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        // POS
        Route::middleware(['auth'])->get('/pos', function () {
            return view('pos.pos');
        })->name('pos');


        Route::middleware(['auth'])->group(function () {
            // users
            Route::resource('/users', userController::class);
            // categories
            Route::resource('/categories', CategoryController::class);
            // products
            Route::resource('/products', ProductController::class);
            // clients
            Route::resource('/clients', ClientController::class);
            Route::resource('/clients.orders', OrderController::class);
            // main Order
            Route::resource('/orders', MainOrderController::class);
            Route::get('/orders/{order}/products', [MainOrderController::class, 'products'])->name('orders.products');
        });
    }
);
