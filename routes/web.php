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

Route::group(['middleware' => 'auth'], function()
{
	Route::resource('companies','CompaniesController');
	Route::post('projects/adduser', 'ProjectsController@adduser')->name('projects.adduser');
	Route::resource('projects','ProjectsController');
	Route::resource('comments','CommentsController');
	Route::resource('roles','RolesController');
	Route::resource('tasks','TasksController');
	Route::get('/findProject','TasksController@findProject');
	Route::resource('users','UsersController');
});