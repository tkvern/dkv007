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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('/user/activate_email', 'Auth\ActivateController@show')->name('user.activate_email');
Route::post('/user/activate_email', 'Auth\ActivateController@sendActivateEmail');
Route::get('/user/activate/{token}', 'Auth\ActivateController@activate')->name('user.activate');

// Route::get('/jwt', 'HomeController@jwt');
// Route::get('/decode_jwt/{token}', 'HomeController@decode_jwt');

// sb-admin
// Route::get('/', function()
// {
// 	return View::make('home');
// });

Route::get('/orders', function()
{
	return View::make('orders.index');
});


Route::get('/tasks', function()
{
	return View::make('tasks.index');
});


Route::get('/tasks/show', function()
{
	return View::make('tasks.show');
});

Route::get('/user/profile', 'UserController@profile');
Route::post('/user/profile', 'UserController@update_profile');

Route::get('/user/password', 'UserController@password');
Route::post('/user/password', 'UserController@change_password');

