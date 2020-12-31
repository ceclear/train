<?php

use Illuminate\Support\Facades\Route;

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
    return view('404');
});

Route::group(['prefix' => 'level1'], function () {
    Route::get('/', 'SchoolController@index');
    Route::get('show/{sub_id?}', 'SchoolController@show');
    Route::post('submit', 'SchoolController@submit');
    Route::get('success', 'SchoolController@success');
});
