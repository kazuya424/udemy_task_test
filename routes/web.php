<?php

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
});

Route::get('tests/test', 'TestController@index');

Route::get('shops/index', 'ShopController@index');

//グループ化する　　フォルダcontactを指定　　認証されたら表示する
Route::group(['prefix' => 'contact', 'middleware' => 'auth'], function () {
    Route::get('index', 'ContactFormController@index')->name('contact.index'); //nameをつけることによってview側で使いやすくなる
    Route::get('create', 'ContactFormController@create')->name('contact.create'); //nameをつけることによってview側で使いやすくなる
    Route::post('store', 'ContactFormController@store')->name('contact.store'); //nameをつけることによってview側で使いやすくなる
    Route::get('show/{id}', 'ContactFormController@show')->name('contact.show'); //idの人を表示
    Route::get('edit/{id}', 'ContactFormController@edit')->name('contact.edit'); //{id}/editでも良い
    Route::post('update/{id}', 'ContactFormController@update')->name('contact.update');
    Route::post('destroy/{id}', 'ContactFormController@destroy')->name('contact.destroy');
});

//REST
//Route::resource('contacts', 'ContactFormController');

Auth::routes(); //認証

Route::get('/home', 'HomeController@index')->name('home');
