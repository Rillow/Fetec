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

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('criar-post','PostController@create');
Route::post('criar-post', 'PostController@store');
Route::get('lista-post', 'PostController@index');
Route::get('visualizar-post/{id}','PostController@show');
Route::get('editar-post/{id}','PostController@edit');
Route::post('editar-post/{id}','PostController@update');
Route::get('deletar-post/{id}','PostController@destroy');

Route::post('adicionar-gostei','PostController@AdicionarGostei');
Route::post('adicionar-naogostei','PostController@AdicionarNaoGostei');

Route::get('pesquisar','PostController@pesquisar');
Route::post('pesquisar','PostController@pesquisar');

Route::post('comentar','PostController@AdicionarComentario');

Route::get('/', 'HomeController@index');
