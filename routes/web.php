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

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::get('/notes', 'NoteController@index');

Route::get('/captcha', 'LoginController@getCaptcha');
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('/reg', 'RegistrationController@store');

Route::get('/emailtest', 'NoteController@email');
Route::get('/reg/verify/{conf_code}', 'ConfirmController@confirm');