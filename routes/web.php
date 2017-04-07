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
Route::get('/home', 'HomeController@index');

/* view('notes') view controller*/
Route::get('/notes', 'NoteController@index');

/* Auth-related Routes*/
Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('/reg', 'RegistrationController@store');
Route::get('/captcha', 'LoginController@getCaptcha');

/* Confirm Controller*/
Route::get('/reg/verify/{conf_code}', 'ConfirmController@confirm');
Route::get('/unlock/{conf_code}', 'ConfirmController@unlock');

/* Links Controller*/
Route::post('/editLink', 'LinksController@update');
Route::post('/deleteLink', 'LinksController@delete');
Route::post('/addLink', 'LinksController@create');

/* Notes Controller*/
Route::post('/editNote', 'NotesController@update');

/* TBD Controller*/
Route::post('/editTbd', 'TBDsController@update');

/* Images Controller*/
Route::post('/addPicture', 'PicturesController@create');
Route::post('/deletePicture', 'PicturesController@deletes');