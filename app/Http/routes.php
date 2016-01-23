<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'DiscussionController@index');
Route::resource('discussion', 'DiscussionController');
Route::get('/send','SitesController@sendmailtest');
Route::get('/make_register_code','UserController@make_register_code');
Route::get('/register_code_list','UserController@register_code_list');
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'UserController@do_register');
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'UserController@login');
Route::get('/avatar', 'UserController@avatar');
Route::post('/avatar', 'UserController@change_avatar');
Route::post('/crop/api', 'UserController@crop_avatar');
Route::get('/send_confirm_mail', 'UserController@send_confirm_mail');
Route::get('/confirm_register', 'UserController@confirm_register');
Route::get('/logout', 'Auth\AuthController@getLogout');
Route::resource('comment', 'CommentsController');
Route::post('/discussion/upload', 'DiscussionController@upload');