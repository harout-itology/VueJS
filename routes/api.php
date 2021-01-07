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

Route::get('/remoteUser', 'LaunchController@index')->name('api.redirection.index');

Route::post('/sendSms', 'LaunchController@sendSms')->name('api.redirection.sendSms');

Route::resource('/templates','TemplateController');

Route::resource('/templateslog','TemplateLogController');
