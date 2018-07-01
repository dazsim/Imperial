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

Route::get('/', 'ResultsController@show_all');

Route::get('/question3','ResultsController2@show_all');
Route::post('/question3','ResultsController2@show_all_filtered');

Route::get('/question4','ResultsController2@show_all');
