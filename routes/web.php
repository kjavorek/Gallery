<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', 'IndexController@index');
Route::post('/', 'IndexController@submit');
Route::get('/myPhotos', 'MyPhotosController@show');
Route::get('/form', 'FormController@form');
Route::post('/form', 'FormController@submit');
Route::get('/thankyou', 'FormController@thankyou');
Route::get('/imageShow', 'ImageShowController@imageShow');
Route::get('/admin', 'AdminController@index');
//filter


Auth::routes();

Route::get('/home', 'HomeController@index');
