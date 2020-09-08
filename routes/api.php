<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::prefix('users')->name('users.')->group(function () {
    Route::get('', 'UserController@getList')->name('getList');
    Route::post('', 'UserController@create')->name('create');
    Route::get('{user}', 'UserController@getOne')->name('getOne');
    Route::put('{user}', 'UserController@update')->name('update');
    Route::delete('{user}', 'UserController@delete')->name('delete');
    Route::delete('', 'UserController@deleteMany')->name('deleteMany');
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($routers) {
    Route::post('login', 'AuthController@login');
});
