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
    Route::get('/search', 'api\UserController@searchProduct');
    Route::get('/all', 'api\ProductController@allProduct');
    Route::get('/comments', 'api\UserController@ProductComments');


});
Route::prefix('store')->group(function () {

    Route::get('/search', 'api\UserController@searchStore');
    Route::get('/all', 'api\StoreController@allStore');
    Route::get('/comments', 'api\UserController@StoreComments');



});
Route::get('/store{id}', 'api\StoreController@store_detail');//اطلاعات یک مغازه را برمی گرداند (id مغازه باید فرستاده شود)
Route::get('/product_store{id}', 'api\StoreController@productOfStore');//محصولات یک مغازه را بر می گرداند
Route::post('/edit_profile', 'api\UserController@editProfile')->middleware('auth:api');
Route::get('/logout', 'api\UserController@logout')->middleware('auth:api');
Route::post('/login', 'api\UserController@login');
Route::post('/register', 'api\UserController@register');
Route::prefix('category')->group(function () {
    Route::get('/store_all', 'api\CategoryController@allStore');//دسته بندی مغازه ها
    Route::get('/product_all', 'api\CategoryController@allProduct');//دسته بندی محصولات
    Route::get('/searchStore', 'api\CategoryController@searchCategoryStore');//سرچ دسته بندی مغازه
    Route::get('/searchProduct', 'api\CategoryController@searchProductStore');//سرچ دسته بندی محصولات
});

Route::middleware([])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('store')->group(function () {
            Route::post('/create', 'api\AdminController@createStore');
            Route::get('/all', 'api\AdminController@allStore');
            Route::get('/delete{store_id}', 'api\AdminController@deleteStore');
            Route::post('/edit', 'api\AdminController@editStore');
            Route::post('/edit_profile_pic', 'api\AdminController@editProfilePic');
            Route::post('/edit_header_pic', 'api\AdminController@editHeaderPic');
            Route::get('/search', 'api\AdminController@searchStore');

        });
        Route::prefix('category')->group(function () {
            Route::prefix('store')->group(function () {
                Route::get('/all', 'api\CategoryController@allStore');// دسته بندی محصولات یک مغازه را برمی گرداند
                Route::post('/add', 'api\CategoryController@addStoreCategory');
                Route::get('/delete{cat_id}', 'api\CategoryController@deleteStoreCategory');
                Route::get('/search', 'api\CategoryController@searchCategoryStore');

            });
            Route::prefix('product')->group(function () {
                Route::get('/all', 'api\CategoryController@allProduct');// دسته بندی محصولات یک مغازه را برمی گرداند
                Route::post('/add', 'api\CategoryController@addProductCategory');
                Route::get('/delete{id}', 'api\CategoryController@deleteProductCategory');
                Route::get('/search', 'api\CategoryController@searchProductStore');
            });
        });
        Route::prefix('product')->group(function () {
            Route::post('/create', 'api\AdminController@createProduct');
            Route::get('/all', 'api\AdminController@allProduct');
            Route::get('/delete{id}', 'api\AdminController@deleteProduct');
            Route::post('/edit', 'api\AdminController@editProduct');
            Route::get('/search', 'api\AdminController@searchProduct');
        });
        Route::prefix('users')->group(function () {
            Route::get('/all', 'api\UserController@allUsers');
            Route::post('/edit', 'api\AdminController@editProfile');
            Route::post('/edit_Profile_pic', 'api\AdminController@editProfilePicture');
            Route::get('/delete{id}', 'api\UserController@deleteUser');
            Route::get('/search', 'api\UserController@searchUser');
            Route::post('/add', 'api\UserController@register');


        });
        Route::prefix('factors')->group(function () {
            Route::get('/all', 'api\FactorController@all');
            Route::get('/search', 'api\AdminController@searchFactor');
        });
        Route::prefix('comment')->group(function () {
            Route::prefix('store_comment')->group(function () {
                Route::get('/all', 'api\AdminController@storeComments');
                Route::get('/search', 'api\AdminController@searchStoreComment');
                Route::get('/delete{id}', 'api\AdminController@deleteStoreComment');

            });
            Route::prefix('product_comment')->group(function () {
                Route::get('/all', 'api\AdminController@productComments');
              Route::get('/search', 'api\AdminController@searchProductComment');
                Route::get('/delete{id}', 'api\AdminController@deleteProductComment');
            });

        });
        Route::get('/roles', 'api\AdminController@roles');
    });
});

Route::middleware(['auth:api', 'scopes:shopOwner'])->group(function () {
    Route::prefix('shopOwner')->group(function () {
        Route::prefix('profile')->group(function () { //پروفایل صاحب مغازه
            Route::post('/edit', 'api\UserController@editProfile');
            Route::post('/edit_picture', 'api\UserController@editProfilePicture');

        });
        Route::post('/searchFactor', 'api\ShopOwnerController@searchFactor');
        Route::prefix('store')->group(function () {
            Route::post('/edit', 'api\StoreController@edit');
            Route::get('/detail', 'api\StoreController@Detail');
            Route::get('/comments', 'api\ShopOwnerController@storeComments');
            Route::get('/delete_Comment{comment_id}', 'api\ShopOwnerController@deleteStoreComment');
            Route::prefix('profile')->group(function () {// پروفایل مغازه
                Route::post('/edit', 'api\CategoryController@editProfile');// دسته بندی محصولات یک مغازه را برمی گرداند
                Route::post('/edit_header_pic', 'api\CategoryController@editHeaderPic');
                Route::post('/edit_profile_pic', 'api\CategoryController@editProfilePic');


            });
        });
        Route::prefix('product')->group(function () {
            Route::get('/all', 'api\ProductController@allProductOfStore');
            Route::get('/search', 'api\ShopOwnerController@searchProduct');
            Route::post('/create', 'api\ProductController@create');
            Route::post('/edit', 'api\ProductController@edit');
            Route::get('/delete{id}', 'api\ProductController@delete');
            Route::get('/detail{id}', 'api\ProductController@Detail');
            Route::get('/comments', 'api\ShopOwnerController@productComments');
            Route::get('/delete_Comment{comment_id}', 'api\ShopOwnerController@deleteProductComment');
        });
        Route::prefix('category')->group(function () {
            Route::get('/all', 'api\CategoryController@productOfStore');// دسته بندی محصولات یک مغازه را برمی گرداند
            Route::post('/add', 'api\CategoryController@addCategoryProductToStore');
            Route::get('/delete', 'api\CategoryController@deleteCategoryProductFromStore');
            Route::get('/search', 'api\CategoryController@searchProductOneStore');

        });

    });
});

Route::prefix('users')->group(function () {
    Route::middleware(['auth:api', 'scope:user'])->group(function () {
        Route::prefix('basket')->group(function () {
            Route::get('/all}', 'api\UserController@basket');
            Route::post('/add{id}', 'api\UserController@addToBasket');
            Route::get('/delete{id}', 'api\UserController@deleteFromBasket');
            Route::post('/payment', 'api\FactorController@PurchaseInvoice');//نهایی کردن خرید های سبد

        });
        Route::prefix('product')->group(function () {
            Route::post('/add_comment', 'api\UserController@addProductComment');

        });
        Route::prefix('store')->group(function () {
            Route::post('/add_comment', 'api\UserController@addStoreComment');
            Route::post('/create', 'api\StoreController@create');

        });
        Route::prefix('profile')->group(function () {
            Route::post('/edit', 'api\UserController@editProfile');
            Route::post('/edit_picture', 'api\UserController@editProfilePicture');

        });
        Route::get('/factor', 'api\UserController@searchFactor');
    });


});
Route::post('/test', 'api\FactorController@test');




