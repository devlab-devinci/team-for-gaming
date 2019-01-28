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

Auth::routes(['verify' => true]);

Route::get('/dashboard', function () {
    return view('user-interface.dashboard');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Home', 'prefix' => 'home', 'as' => 'home.'], function()
{
    Route::resource('game', 'GameController');

    Route::resource('team', 'TeamController');

    Route::resource('organisation', 'OrganisationController');

    Route::resource('user', 'UserController');
});