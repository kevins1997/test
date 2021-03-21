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
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::post('/time-sheets/filter', 'App\Http\Controllers\TimeSheetController@filter')->name('filter');
    Route::resource('time-sheets', 'App\Http\Controllers\TimeSheetController');
    Route::group(['middleware' => 'admin'], function () {
        Route::resource('projects', 'App\Http\Controllers\ProjectController');
        Route::resource('users', 'App\Http\Controllers\UserController');
        Route::resource('activity-types', 'App\Http\Controllers\ActivityTypeController');
    });
});

