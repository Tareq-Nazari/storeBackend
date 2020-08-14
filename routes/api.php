<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/farid','api\UserController@farid');
Route::prefix('admin')->group(function () {
    Route::prefix('store')->group(function () {
        Route::post('/create', 'api\AdminController@createStore');
        Route::post('/delete', 'api\AdminController@deleteStore');
        Route::post('/edit', 'api\AdminController@editStore');
        Route::post('/search', 'api\AdminController@searchStore');
        Route::post('/category', 'api\StoreController@allStoreCategories');//دسته بندی مغازه ها
    });
    Route::prefix('product')->group(function () {
        Route::post('/create', 'api\AdminController@createProduct');
        Route::post('/delete{id}', 'api\AdminController@deleteProduct');
        Route::post('/edit', 'api\AdminController@editProduct');
        Route::post('/search', 'api\AdminController@searchProduct');
    });
    Route::post('/factor', 'api\AdminController@searchFactor');

});
Route::prefix('shopOwner')->group(function () {
    Route::post('/searchFactor', 'api\ShopOwnerController@searchFactor');
    Route::prefix('store')->group(function () {
        Route::post('/create', 'api\StoreController@create');
        Route::post('/edit', 'api\StoreController@edit');
        Route::post('/detail', 'api\StoreController@Detail');

    });
    Route::prefix('product')->group(function () {
        Route::post('/all', 'api\ProductController@allProduct');
        Route::post('/search', 'api\ShopOwnerController@searchProduct');
        Route::post('/create', 'api\ProductController@create');
        Route::post('/edit', 'api\ProductController@edit');
        Route::post('/delete{id}', 'api\ProductController@delete');
        Route::post('/detail{id}', 'api\ProductController@Detail');
    });
    Route::prefix('category')->group(function () {
        Route::post('/all', 'api\ProductController@categoriesProductOfStore');// دسته بندی محصولات یک مغازه را برمی گرداند
        Route::post('/add', 'api\ProductController@addCategory');
        Route::post('/delete', 'api\ProductController@deleteCategory');
    });
});


Route::prefix('users')->group(function () {
    Route::prefix('basket')->group(function () {
        Route::post('/all}', 'api\UserController@basket');
        Route::post('/add{id}', 'api\UserController@addToBasket');
        Route::post('/delete{id}', 'api\UserController@deleteFromBasket');
        Route::post('/payment', 'api\FactorController@PurchaseInvoice');//نهایی کردن خرید های سبد

    });
    Route::post('/login', 'api\UserController@login');
    Route::post('/register', 'api\UserController@register');
    Route::post('/logout', 'api\UserController@logout');
    Route::post('/edit', 'api\UserController@editProfile');
    Route::post('/factor', 'api\UserController@searchFactor');
    Route::post('/product', 'api\UserController@searchProduct');
    Route::post('/store', 'api\UserController@searchStore');

});

Route::post('/login', 'api\UserController@login');
Route::get('/products', 'api\ProductController@allProduct');
Route::post('/register', 'api\UserController@register');
Route::middleware(['auth:api', 'scope:do_anything'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('/test', 'HiController@test');
        Route::post('/create_post', 'api\AdminController@create_post');

    });
});



