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
    return view('login');
});

Route::post('/processLogin', 'LoginController@login');

Route::get('/notes', 'NoteController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/register', function() {
    return view('register');
});

Route::get('/captcha', 'LoginController@getCaptcha');