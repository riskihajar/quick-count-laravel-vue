<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::resource('data', 'DataController');

Route::get('/', function () {
    return view('display');
});
Route::get('input', function () {
    return view('input');
});

Route::get('token', function(){
    return csrf_token();
});
