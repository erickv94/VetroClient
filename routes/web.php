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
})->name('home');


Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/products/edit/{id}', 'ProductController@edit')->name('products.edit');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'users'],function (){
	#routes of users
	Route::get('/','UserController@index')->name('users.index');
	Route::get('/list','UserController@list')->name('users.list');
	Route::put('/update/{id}','UserController@update')->name('users.update');
	#Route::get('/{id}','UserController@show')->name('users.show');
	Route::put('/toggle/{id}','UserController@toggle')->name('users.toggle');
	Route::post('/','UserController@store')->name('users.store');
});