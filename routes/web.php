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

Route::get('/dashboard', 'GameController@index');

Route::post('gameLevel/fetch', 'GameController@fetchGameLevel')->name('game.fetch-game-level');

Route::post('game/create', 'GameController@storeGameUser')->name('game.create');

Route::get('/home', 'HomeController@index')->name('home');
