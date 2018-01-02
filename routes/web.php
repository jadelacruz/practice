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

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'UserController@profile')->name('profile');

Route::get('/post', 'PostController@index')->name('post');

Route::get('/post/create', 'PostController@create')->name('post.create');

Route::post('/post', 'PostController@store');

Route::get('/post/{post}', 'PostController@show');

Route::get('/post/recipient/{post}', 'PostController@getRecipientByPostId');

Route::get('/post/{post}/edit', 'PostController@edit')->name('post.edit');

Route::delete('/post/{post}', 'PostController@destroy');

Route::get('/recipient/userNotViewedNotification', 'RecipientController@getUserNotViewedNotification');

Route::get('/recipient/viewed/{recipient}', 'RecipientController@viewed');

Route::get('/recipient/{recipient}', 'RecipientController@show');

Auth::routes();