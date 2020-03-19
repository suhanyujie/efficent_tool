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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'search', 'middleware' => [] ], function () {
    // 获取 token
    Route::any('/getToken', 'Tool\SearchController@getToken');
    Route::get('/getList', 'Tool\SearchController@getList');

    Route::any('/addData', 'Tool\SearchController@addData');
});

