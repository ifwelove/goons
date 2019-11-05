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

// Auth::routes();
Auth::routes(['register' => false]);


Route::group(['prefix' => 'permissions', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::match(['get', 'head'], '/', 'PermissionController@index')->name('permissions.index');
    Route::post('/', 'PermissionController@store')->name('permissions.store');
    Route::match(['get', 'head'], '/create', 'PermissionController@create')->name('permissions.create');
    Route::delete('/{permission}', 'PermissionController@destroy')->name('permissions.destroy');
    Route::match(['get', 'head'], '/{permission}', 'PermissionController@show')->name('permissions.show');
    Route::match(['put', 'patch'], '/{permission}', 'PermissionController@update')->name('permissions.update');
    Route::match(['get', 'head'], '/{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
});

Route::group(['prefix' => 'roles', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::match(['get', 'head'], '/', 'RoleController@index')->name('roles.index');
    Route::post('/', 'RoleController@store')->name('roles.store');
    Route::match(['get', 'head'], '/create', 'RoleController@create')->name('roles.create');
    Route::delete('/{role}', 'RoleController@destroy')->name('roles.destroy');
    Route::match(['get', 'head'], '/{role}', 'RoleController@show')->name('roles.show');
    Route::match(['put', 'patch'], '/{role}', 'RoleController@update')->name('roles.update');
    Route::match(['get', 'head'], '/{role}/edit', 'RoleController@edit')->name('roles.edit');
});

Route::group(['prefix' => 'accounts', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::match(['get', 'head'], '/', 'AccountController@index')->name('accounts.index');
    Route::post('/', 'AccountController@store')->name('accounts.store');
    Route::match(['get', 'head'], '/create', 'AccountController@create')->name('accounts.create');
    Route::delete('/{account}', 'AccountController@destroy')->name('accounts.destroy');
    Route::match(['get', 'head'], '/{account}', 'AccountController@show')->name('accounts.show');
    Route::match(['put', 'patch'], '/{account}', 'AccountController@update')->name('accounts.update');
    Route::match(['get', 'head'], '/{account}/edit', 'AccountController@edit')->name('accounts.edit');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', 'DashboardController@logout');
    Route::get('home', 'DashboardController@index');
    Route::get('/', 'DashboardController@index');
});

Route::resource('programs', 'ProgramController');
Route::resource('news', 'NewsController');
Route::resource('pushs', 'PushController');
Route::resource('categories', 'CategoryController');
