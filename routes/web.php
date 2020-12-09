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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'MainController@index')->name('admin.index');
    Route::get('/currency', 'CurrencyController@index')->name('currency.index');
    Route::get('/get-currency', 'CurrencyController@get')->name('get_currency');

    Route::resource('attributes', AttributesController::class);
    Route::resource('categories', CategoryController::class);

});
