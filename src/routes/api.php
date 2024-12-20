<?php 

use Pericao\Orm\Http\Route;

Route::get('/', 'HomeController@index');
Route::get('/client', 'ClientController@index');