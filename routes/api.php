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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['prefix' => 'accounts', 'middleware' => []], function () {
    Route::match(['get', 'head'], '/', 'Api\AccountController@index');
    Route::post('/', 'Api\AccountController@store');
    Route::match(['get', 'head'], '/create', 'Api\AccountController@create');
    Route::delete('/{account}', 'Api\AccountController@destroy');
    Route::match(['put', 'patch'], '/{account}/status', 'Api\AccountController@updateStatus');
    Route::match(['put', 'patch'], '/{account}', 'Api\AccountController@update');
    Route::match(['get', 'head'], '/{account}/edit', 'Api\AccountController@edit');
});

//Route::post('upload/category/image', 'Api\CategoryController@storeImage');
Route::group(['prefix' => 'categories', 'middleware' => []], function () {
    Route::match(['get', 'head'], '/', 'Api\CategoryController@index');
    Route::post('/', 'Api\CategoryController@store');
    Route::post('/image', 'Api\CategoryController@storeImage');
    Route::delete('/{category}', 'Api\CategoryController@destroy');
    Route::match(['put', 'patch'], '/{category}/status', 'Api\CategoryController@updateStatus');
    Route::match(['put', 'patch'], '/{category}/{type}/sort', 'Api\CategoryController@updateSort');
    Route::match(['put', 'patch'], '/{category}', 'Api\CategoryController@update');
    Route::match(['get', 'head'], '/{category}/edit', 'Api\CategoryController@edit');
});

Route::group(['prefix' => 'programs', 'middleware' => []], function () {
    Route::match(['get', 'head'], '/', 'Api\ProgramController@index');
    Route::post('/', 'Api\ProgramController@store');
    Route::delete('/{program}', 'Api\ProgramController@destroy');
    Route::match(['put', 'patch'], '/{program}', 'Api\ProgramController@update');
    Route::match(['get', 'head'], '/{program}/edit', 'Api\ProgramController@edit');
});


Route::post('messageList', 'NewsController@messageListApi');
Route::post('setToken', 'DeviceController@setTokenApi');
Route::post('programDescription', 'CategoryController@programDescriptionApi');
Route::post('programList', 'ProgramController@programListApi');
Route::post('program', 'ProgramController@programApi');
