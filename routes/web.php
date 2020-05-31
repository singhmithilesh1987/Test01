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
Route::get('/add-detail', [
	'uses'=> 'usersController@create',
	'as'=> 'user.create'
]);
Route::post('/store', [
	'uses'=> 'usersController@store',
	'as'=> 'user.store'
]);
Route::post('/checkemail', [
	'uses'=> 'usersController@checkEmail',
	'as'=> 'user.checkemail'
]);