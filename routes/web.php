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

Route::group(['prefix' => 'tool', 'middleware' => [] ], function () {
    Route::get('/imageUpload', 'FileController@imgStore');
});

Route::group(['prefix' => 'search', 'middleware' => [] ], function () {
    // 获取 token
    Route::any('/getToken', 'Tool\SearchController@getToken');
    Route::get('/getList', 'Tool\SearchController@getList');

    Route::any('/addData', 'Tool\SearchController@addData');
});
