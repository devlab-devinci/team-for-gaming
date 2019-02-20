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


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['namespace' => 'Home', 'prefix' => 'home', 'as' => 'home.'], function()
{
    // Games
    Route::resource('game', 'GameController');

    Route::get('/dashboard', 'GameController@index');

    Route::post('gameLevel/fetch', 'GameController@fetchGameLevel')->name('game.fetch-game-level');

    Route::post('game/create', 'GameController@storeGameUser')->name('game.create');

    // Teams
    Route::resource('team', 'TeamController');

    Route::get('getGameRoles/{gameId}', 'TeamController@getGameRoles');

    Route::get('answerTeamInvitation/{userRoleId}/{status}', 'TeamController@answerTeamInvitation');

    // Organisations
    Route::resource('organisation', 'OrganisationController');

    // Settings
    Route::resource('user', 'UserController');
});