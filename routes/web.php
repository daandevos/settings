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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('user/setting', 'UserSettingController@edit');
    Route::patch('user/setting', 'UserSettingController@update');

    Route::middleware(['role:administrator'])->group(function () {
        Route::post('setting', 'SettingController@store');
        Route::get('setting/create', 'SettingController@create');
    });
});
