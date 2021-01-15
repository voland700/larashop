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




    Route::post('/category_img','ImgDeleteController@category_img')->name('category_img');
    Route::post('/product_img_remove', 'ImgDeleteController@imgProductRemove')->name('img_remove');
    Route::post('/product_image_remove', 'ImgDeleteController@imageProductRemove')->name('image_remove');
    Route::post('/product_image_all_remove', 'ImgDeleteController@imageAllProductRemove')->name('image_all_remove');

    Route::resource('attributes', AttributesController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductsController::class);

});
