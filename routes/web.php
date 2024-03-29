<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
})->name('clear.cash');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'MainController@index')->name('admin.index');
    Route::get('/currency', 'CurrencyController@index')->name('currency.index');
    Route::get('/get-currency', 'CurrencyController@get')->name('get_currency');
    Route::get('/update-prices', 'CurrencyController@updatePrices')->name('update_prices');

    Route::get('/catalog_list/{id?}', 'ProductsController@list')->name('catalog_list');
    Route::get('/new_product/{id?}', 'ProductsController@make')->name('new_product');
    Route::post('/product_create','ProductsController@store')->name('product_create');
    Route::delete('/product_delete/{id}/{category?}','ProductsController@delete')->name('product_delete');

    Route::post('/discounts_goods','DiscountController@goods')->name('discounts_goods');
    Route::post('/discounts_choice','DiscountController@choice')->name('discounts_choice');

    Route::post('/discounts_goods_update','DiscountController@goods_update')->name('discounts_goods_update');
    Route::post('/discounts_choice_update','DiscountController@choice_update')->name('discounts_choice_update');



    Route::get('/discounts_paginate','DiscountController@paginate')->name('discounts_paginate');
    Route::post('/discounts_paginate_update','DiscountController@paginate_update')->name('discounts_paginate_update');


    Route::post('/category_img','ImgDeleteController@category_img')->name('category_img');
    Route::post('/product_img_remove', 'ImgDeleteController@imgProductRemove')->name('img_remove');
    Route::post('/product_image_remove', 'ImgDeleteController@imageProductRemove')->name('image_remove');
    Route::post('/product_image_all_remove', 'ImgDeleteController@imageAllProductRemove')->name('image_all_remove');



    Route::post('/slide_remove', 'ImgDeleteController@slideRemove')->name('slide_remove');
    Route::post('/banner_remove', 'ImgDeleteController@bannerRemove')->name('banner_remove');
    Route::post('/slider_icons_remove','SlidericonsController@remove')->name('slider_icons_remove');

    Route::post('/brand_img_remove', 'BrandController@brandImgRemove')->name('brand_img_remove');
    Route::post('/service_img_remove', 'ServiceController@ServiceImgRemove')->name('service_img_remove');

    Route::post('blogs_img_upload','BlogController@upload')->name('blogs_img_upload');
    Route::post('blogs_img_remove','BlogController@remove')->name('blogs_img_remove');

    Route::post('blogs_gallery_remove','BlogController@galleryRemove')->name('blogs_gallery_remove');
    Route::post('blogs_gallery_all_remove','BlogController@galleryAllRemove')->name('blogs_gallery_all_remove');
    Route::post('blogs_images_remove','BlogController@imagesRemove')->name('blogs_images_remove');

    Route::post('users_search','UserController@search')->name('users_search');





    Route::resource('attributes', AttributesController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('discounts', DiscountController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('advantages', AdvantageController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('slider_icons', SlidericonsController::class);





    Route::resource('permissions', 'PermissionController');
    Route::resource('roles', 'RolesController');
    Route::resource('users', 'UserController');
});
