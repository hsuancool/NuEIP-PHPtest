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

Route::get('/nueip/accounts/{accountId}', 'User\AccountInfoController@show');
Route::patch('/nueip/accounts/{accountId}', 'User\AccountInfoController@update');
Route::delete('/nueip/accounts/{accountId}', 'User\AccountInfoController@delete');
Route::get('/nueip/accounts', 'User\AccountInfoController@list');
Route::post('/nueip/accounts', 'User\AccountInfoController@create');