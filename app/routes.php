<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'PagesController@home');

//Route::group(['prefix' => 'api'], function(){
//    Route::resource('users', 'UsersController');
//});
//
//Route::group(['prefix' => 'admin'], function(){
//    Route::get('login', 'SessionsController@getLogin');
//    Route::post('login', 'SessionsController@postLogin');
//});