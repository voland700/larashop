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
    Artisan::call('backup:clean');
    return "Кэш очищен.";
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'MainController@index')->name('admin.index');
    Route::get('/currency', 'CurrencyController@index')->name('currency.index');
    Route::get('/get-currency', 'CurrencyController@get')->name('get_currency');
    Route::post('/category_img','ImgDeleteController@category_img')->name('category_img');
    Route::get('/new_product/{id?}', 'ProductsController@make')->name('new_product');

    Route::resource('attributes', AttributesController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductsController::class);

});
