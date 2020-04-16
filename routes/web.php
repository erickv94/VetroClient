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
    return view('welcome');
})->name('welcome')->middleware('auth');

Route::group(['prefix' => 'products','middleware'=>['auth']], function () {
    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('/edit/{id}', 'ProductController@edit')->name('products.edit');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'users','middleware'=>['auth']],function (){
	#routes of users
	Route::get('/','UserController@index')->name('users.index');
	Route::get('/list','UserController@list')->name('users.list');
	Route::put('/update/{id}','UserController@update')->name('users.update');
	Route::post('/','UserController@store')->name('users.store');
	Route::get('/profile/{id}','UserController@profile')->name('editprofile');
	Route::put('/updateprofile/{id}','UserController@updateprofile')->name('updateprofile');
});




Route::group(['prefix' => 'prices','middleware'=>['auth']], function () {
    Route::get('/','PriceController@index')->name('prices.index');
    Route::get('/loadjson','PriceController@loadData')->name('prices.load_data');
    Route::get('/{id}','PriceController@checkPrices')->name('prices.check');
});
