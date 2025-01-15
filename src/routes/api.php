<?php 

use Pericao\Orm\Http\Route;

Route::get('/', 'HomeController@index');
Route::get('/client', 'ClientController@index');
Route::get('/client/{id}', 'ClientController@show');
Route::post('/client', 'ClientController@store');

Route::get('/',                     'HomeController@index');
Route::get('/users',        'UserController@store');
Route::post('/users',        'UserController@store');
Route::post('/users/login',         'UserController@login');
Route::get('/users/fetch',          'UserController@fetch');
Route::put('/users/update',         'UserController@update');
Route::delete('/users/{id}/delete', 'UserController@remove');