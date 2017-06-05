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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/videos/create', [
        'as' => 'videos.create',
        'uses' => 'VideoController@create'
    ]);

    Route::post('/videos', [
        'as' => 'videos.store',
        'uses' => 'VideoController@store'
    ]);

    Route::get('/videos', [
        'as' => 'videos.index',
        'uses' => 'VideoController@index'
    ]);
});



