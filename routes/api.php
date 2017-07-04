<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth', 'AuthController@create');
Route::group(['middleware' => 'auth:api'], function () {
    header("Access-Control-Allow-Origin: *");
    
    Route::get('/user', 'UserController@show');
    Route::post('/user/task_orders', 'TaskOrdersController@create');
    Route::get('/user/task_orders', 'TaskOrdersController@index');
    Route::get('/user/task_orders/{order_sn}', 'TaskOrdersController@show');
    Route::get('/user/tasks', 'TasksController@index');
    Route::get('/user/tasks/{task_id}', 'TasksController@show');
    Route::post('user/tasks/{task_id}/storage', 'TasksController@updateStorage');

    // Route::post('/upload/image', 'UploadController@storeImage');
    Route::post('/upload/file', 'UploadController@storeFile');
    // Route::post('/upload/delete', 'UploadController@deleteFile');
});
