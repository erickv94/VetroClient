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
Route::get('test',"TestController@index");
Route::get('/', function () {
    return view('welcome');
})->name('welcome')->middleware('auth');

Route::group(['prefix' => 'products','middleware'=>['auth','has.permission:products.index']], function () {
    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('/edit/{id}', 'ProductController@edit')->name('products.edit')->middleware('has.permission:products.text.edit');
    Route::post('/update/description','ProductController@updateDescription')->name('products.update.desc')->middleware('has.permission:products.text.edit');
    Route::post('/update/metadescription','ProductController@updateMeta')->name('products.update.meta')->middleware('has.permission:products.text.edit');
    Route::post('/update/keywords','ProductController@updateKeyword')->name('products.update.keywords')->middleware('has.permission:products.text.edit');
    Route::post('/update/title','ProductController@updateTitle')->name('products.update.title')->middleware('has.permission:products.text.edit');
    Route::get('/edit/images/{id}','ProductController@imagesEdit')->name('products.images')->middleware('has.permission:products.image.edit');
    Route::post('/update/images','ProductController@updateImages')->name('products.update.image')->middleware('has.permission:products.image.edit');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'users','middleware'=>['auth','has.role:admin']],function (){
	#routes of users
	Route::get('/','UserController@index')->name('users.index');
	Route::get('/list','UserController@list')->name('users.list');
	Route::put('/update/{id}','UserController@update')->name('users.update');
	Route::post('/','UserController@store')->name('users.store');
});

Route::get('/profile/{id}','UserController@profile')->name('editprofile')->middleware('auth');
Route::put('/updateprofile/{id}','UserController@updateprofile')->name('updateprofile')->middleware('auth');

Route::group(['prefix' => 'prices','middleware'=>['auth','has.permission:prices.index']], function () {
    Route::get('/','PriceController@index')->name('prices.index');
    Route::get('/loadjson','PriceController@loadData')->name('prices.load_data');
    Route::get('/{id}','PriceController@checkPrices')->name('prices.check');
    Route::get('/geturl/{id}','PriceController@getUrl')->name('prices.geturl');
    Route::post('/posturl/{id}','PriceController@UpdateUrls')->name('prices.posturl');

});


Route::group(['prefix' => 'logs','middleware'=>['auth','has.permission:logs.check']], function () {
    Route::get('/', 'LogController@index')->name('logs.index');
    Route::get('/show/{id}', 'LogController@show')->name('logs.show');
});
