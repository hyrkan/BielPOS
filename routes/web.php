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
    return redirect('login');
});
Auth::routes(['register' => false] );
Route::group(['middleware'=>'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/account','RegisterController');
    Route::resource('/store','StoreController');
    Route::resource('/product','ProductController');
    Route::resource('/inventory','StockInController');
    Route::post('/getProduct','CartController@getProduct');
    Route::post('/cart_out','CartController@store');
    Route::get('/getLowStock', 'CartController@getLowStock');
    Route::get('/getTransact', 'CartController@getTransact');
    Route::resource('/report', 'ReportsController');
    Route::get('generate-pdf/{id}','ReportsController@invoice');
    
});
Route::get( '/{path?}', function(){
    return view( 'home' );
} )->where('path', '.*');


