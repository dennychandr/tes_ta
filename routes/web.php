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
    return view('dashboard');
});

Route::get('/user', 'UserController@index');
Route::get('/user/edit/{id}', 'UserController@edit');
Route::post('/user/update/{id}', 'UserController@update');
Route::get('/user/delete/{id}', 'UserController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/home2', 'HomeController@index');

Route::get('bantuan', function () {
    // Only executed if {id} is numeric...
});


Route::get('/bencana', 'HomeController@bencana');