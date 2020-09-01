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

// Login Route
Route::get('login', [ 'as'=> 'login', 'uses'=>'AuthController@index']);
Route::get('forgot-password',['as'=>'forgot_password','uses'=>'AuthController@forgot']);
Route::post('login', ['as'=>'login_action','uses'=>'AuthController@authenticate']);

Route::middleware(['web','auth'])->group(function() {
	// Index 
	Route::get('/', ['as'=>'home','uses'=>'Index\IndexController@index']);
	// Logout
	Route::get('logout',['as'=>'logout','uses'=>'AuthController@logout']);
	// Group
	Route::prefix('group')->group(function() {
		Route::get('/',['as'=>'group.index','uses'=>'Group\GroupController@index']);
	});
});