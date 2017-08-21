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

Route::get('/orders', 'TaskOrdersController@index');
Route::get('/orders/{order_id}', 'TaskOrdersController@show');


Route::get('/tasks', 'TasksController@index');

Route::get('/tasks/{task_id}', 'TasksController@show');

Route::get('/user/profile', 'UserController@profile');
Route::post('/user/profile', 'UserController@update_profile');

Route::get('/user/password', 'UserController@password');
Route::post('/user/password', 'UserController@change_password');

Route::get('/upload/index', 'UploadImageController@index');
Route::get('/upload/{upload}/edit', 'UploadImageController@edit');
Route::post('/upload/{upload}/update', 'UploadImageController@update');
Route::post('/upload/store', 'UploadImageController@store');

Route::get('/activities/index', 'ActivitiesController@index');
Route::get('/activities/create', 'ActivitiesController@create');
Route::get('/activities/{activity_no}/edit', 'ActivitiesController@edit');
Route::post('/activities/store', 'ActivitiesController@store');
Route::post('/activities/{activity_no}/update', 'ActivitiesController@update');


Route::get('/share/activity/{activity_no}', 'ShareController@activity');
Route::get('/share/xml/{activity_no}.xml', 'ShareController@activity_xml');

Route::get('/share', 'ShareController@index');
Route::get('/share/image/{key}', 'ShareController@show');
Route::get('/vrplay/{key}.xml', 'ShareController@xml');

Route::get('/upload', function() {
  return view('upload');
});
