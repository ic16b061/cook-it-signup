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


Route::get('/kontakt', 'ContactController@show');

Route::post('/kontakt', 'ContactController@send');

Route::get('/registrieren', 'SignupController@show');

Route::post('/registrieren', 'SignupController@create');

Route::get('/health', 'HealthCheckController@check');
