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

Route::get('/', function () {
    return view('welcome');
});
Route::get('user/{id}', function ($id) {
    return 'User '.$id;
});

Route::group(['prefix' => 'api','middleware' => 'test'], function () {
    Route::post('generateToken', 'TestController@generateToken');
    Route::post('verifyToken', 'TestController@verifyToken');
    Route::post('fileUpload', 'TestController@fileUpload');
    Route::get('getData', 'TestController@getData');
    Route::post('updateData', 'TestController@updateData');
    Route::get('generateData', 'TestController@generateData');
    Route::post('uploadData', 'TestController@uploadFile');
});