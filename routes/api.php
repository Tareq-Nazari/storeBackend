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
Route::prefix('product')->group(function () {
    Route::post('/search', 'api\UserController@searchProduct');
    Route::post('/all', 'api\ProductController@allProduct');
});
Route::prefix('store')->group(function () {
    Route::post('/search', 'api\UserController@searchStore');
    Route::post('/all', 'api\StoreController@allStore');
});
Route::post('/edit_profile', 'api\UserController@editProfile')->middleware('auth:api');
Route::post('/logout', 'api\UserController@logout')->middleware('auth:api');
Route::post('/login', 'api\UserController@login');
Route::post('/register', 'api\UserController@register');
Route::prefix('category')->group(function () {
    Route::post('/store_all', 'api\CategoryController@allStore');//دسته بندی مغازه ها
    Route::post('/product_all', 'api\CategoryController@allProduct');//دسته بندی محصولات
    Route::post('/searchStore', 'api\CategoryController@searchCategoryStore');//سرچ دسته بندی مغازه
    Route::post('/searchProduct', 'api\CategoryController@searchProductStore');//سرچ دسته بندی محصولات
});

Route::middleware(['auth:api','scope:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('store')->group(function () {
            Route::post('/create', 'api\AdminController@createStore');
            Route::post('/all', 'api\AdminController@allStore');
            Route::post('/delete{store_id}', 'api\AdminController@deleteStore');
            Route::post('/edit', 'api\AdminController@editStore');
            Route::post('/search', 'api\AdminController@searchStore');
            Route::prefix('category')->group(function () {
                Route::prefix('store')->group(function () {
                    Route::post('/all', 'api\CategoryController@allStore');// دسته بندی محصولات یک مغازه را برمی گرداند
                    Route::post('/add', 'api\CategoryController@addStoreCategory');
                    Route::post('/delete{cat_id}', 'api\CategoryController@deleteStoreCategory');
                    Route::post('/search', 'api\CategoryController@searchCategoryStore');
                });
                Route::prefix('product')->group(function () {
                    Route::post('/all', 'api\CategoryController@allProduct');// دسته بندی محصولات یک مغازه را برمی گرداند
                    Route::post('/add', 'api\CategoryController@addProductCategory');
                    Route::post('/delete{cat_id}', 'api\CategoryController@deleteProductCategory');
                    Route::post('/search', 'api\CategoryController@searchProductStore');
                });
            });
        });
        Route::prefix('product')->group(function () {
            Route::post('/create', 'api\AdminController@createProduct');
            Route::post('/delete{id}', 'api\AdminController@deleteProduct');
            Route::post('/edit', 'api\AdminController@editProduct');
            Route::post('/search', 'api\AdminController@searchProduct');
        });
        Route::post('/factor', 'api\AdminController@searchFactor');


    });
});
Route::middleware(['auth:api', 'scope:shopOwner'])->group(function () {
    Route::prefix('shopOwner')->group(function () {
        Route::post('/searchFactor', 'api\ShopOwnerController@searchFactor');
        Route::prefix('store')->group(function () {
            Route::post('/create', 'api\StoreController@create');
            Route::post('/edit', 'api\StoreController@edit');
            Route::post('/detail', 'api\StoreController@Detail');

        });
        Route::prefix('product')->group(function () {
            Route::post('/all', 'api\ProductController@allProductOfStore');
            Route::post('/search', 'api\ShopOwnerController@searchProduct');
            Route::post('/create', 'api\ProductController@create');
            Route::post('/edit', 'api\ProductController@edit');
            Route::post('/delete{id}', 'api\ProductController@delete');
            Route::post('/detail{id}', 'api\ProductController@Detail');
        });
        Route::prefix('category')->group(function () {
            Route::post('/all', 'api\CategoryController@productOfStore');// دسته بندی محصولات یک مغازه را برمی گرداند
            Route::post('/add', 'api\CategoryController@addCategoryProductToStore');
            Route::post('/delete', 'api\CategoryController@deleteCategoryProductFromStore');
            Route::post('/search', 'api\CategoryController@searchProductOneStore');

        });
    });
});

Route::prefix('users')->group(function () {
    Route::middleware(['auth:api', 'scope:user'])->group(function () {
        Route::prefix('basket')->group(function () {
            Route::post('/all}', 'api\UserController@basket');
            Route::post('/add{id}', 'api\UserController@addToBasket');
            Route::post('/delete{id}', 'api\UserController@deleteFromBasket');
            Route::post('/payment', 'api\FactorController@PurchaseInvoice');//نهایی کردن خرید های سبد

        });
        Route::post('/factor', 'api\UserController@searchFactor');
    });


});




