<?php 

use Pericao\Orm\Http\Route;

Route::get('/', 'HomeController@index');
Route::get('/client', 'ClientController@index');
Route::get('/client/{id}', 'ClientController@show');
Route::post('/client', 'ClientController@store');
Route::put('/client/{id}', 'ClientController@update');
Route::put('/login', 'LoginController@login');
