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

//Route::get('test', function () {
//});
// Auth::routes();
Auth::routes(['register' => false]);


//Route::group(['prefix' => 'permissions', 'middleware' => ['auth', 'isAdmin']], function () {
//    Route::match(['get', 'head'], '/', 'PermissionController@index')
//        ->name('permissions.index');
//    Route::post('/', 'PermissionController@store')
//        ->name('permissions.store');
//    Route::match(['get', 'head'], '/create', 'PermissionController@create')
//        ->name('permissions.create');
//    Route::delete('/{permission}', 'PermissionController@destroy')
//        ->name('permissions.destroy');
//    Route::match(['get', 'head'], '/{permission}', 'PermissionController@show')
//        ->name('permissions.show');
//    Route::match(['put', 'patch'], '/{permission}', 'PermissionController@update')
//        ->name('permissions.update');
//    Route::match(['get', 'head'], '/{permission}/edit', 'PermissionController@edit')
//        ->name('permissions.edit');
//});

//Route::group(['prefix' => 'roles', 'middleware' => ['auth', 'isAdmin']], function () {
//    Route::match(['get', 'head'], '/', 'RoleController@index')
//        ->name('roles.index');
//    Route::post('/', 'RoleController@store')
//        ->name('roles.store');
//    Route::match(['get', 'head'], '/create', 'RoleController@create')
//        ->name('roles.create');
//    Route::delete('/{role}', 'RoleController@destroy')
//        ->name('roles.destroy');
//    Route::match(['get', 'head'], '/{role}', 'RoleController@show')
//        ->name('roles.show');
//    Route::match(['put', 'patch'], '/{role}', 'RoleController@update')
//        ->name('roles.update');
//    Route::match(['get', 'head'], '/{role}/edit', 'RoleController@edit')
//        ->name('roles.edit');
//});

Route::group(['prefix' => 'accounts', 'middleware' => ['auth', 'role:account']], function () {
    Route::match(['get', 'head'], '/', 'AccountController@index')
        ->name('accounts.index');
    Route::post('/', 'AccountController@store')
        ->name('accounts.store');
    Route::match(['get', 'head'], '/create', 'AccountController@create')
        ->name('accounts.create');
    Route::delete('/{account}', 'AccountController@destroy')
        ->name('accounts.destroy');
    Route::match(['get', 'head'], '/{account}', 'AccountController@show')
        ->name('accounts.show');
    Route::match(['put', 'patch'], '/{account}/status', 'AccountController@updateStatus')
        ->name('accounts.status.update');
    Route::match(['put', 'patch'], '/{account}', 'AccountController@update')
        ->name('accounts.update');
    Route::match(['get', 'head'], '/{account}/edit', 'AccountController@edit')
        ->name('accounts.edit');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', 'DashboardController@logout');
    Route::get('home', 'DashboardController@index');
    Route::get('/', 'DashboardController@index');
});

Route::group(['middleware' => ['auth', 'role:program']], function() {
    Route::resource('programs', 'ProgramController');
});

Route::group(['middleware' => ['auth', 'role:news']], function() {
    Route::resource('news', 'NewsController');
});

Route::group(['middleware' => ['auth', 'role:push']], function() {
    Route::resource('pushs', 'PushController');
});

Route::group(['middleware' => ['auth', 'role:category']], function() {
    Route::resource('categories', 'CategoryController');
});

//Route::get('parser', 'ProgramController@parser');
Route::match(['get', 'head'], 'news/{news}', 'NewsController@show');
Route::match(['get', 'head'], '{programType}/{categoryId}/{programId}', 'ShareController@linkShow');//分享的靜態頁面
Route::match(['get', 'head'], 'share/{programType}/{categoryId}/{programId}', 'ShareController@show');//分享的靜態頁面

Route::match(['get', 'head'], 'cron/mp3', 'CronController@mp3');//將節目音源長度0的做下載擷取長度
Route::match(['get', 'head'], 'cron/news', 'CronController@news');//沒推播的新聞進行預約或立即推播
Route::match(['get', 'head'], 'cron/pushs', 'CronController@pushs');//沒推播的進行推播
//Route::match(['get', 'head'], 'cron/push/curl', 'CronController@pushByCurl');
//Route::match(['get', 'head'], 'cron/push/fcm', 'CronController@pushByFcm');
Route::match(['get', 'head'], '.well-known/apple-app-site-association', 'DownloadController@iosJson');
Route::match(['get', 'head'], 'apple-app-site-association', 'DownloadController@iosJsonDisplay');
Route::match(['get', 'head'], '.well-known/assetlinks.json', 'DownloadController@iosJson');
