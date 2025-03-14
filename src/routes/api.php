<?php 

use Pericao\Orm\Http\Middleware;
use Pericao\Orm\Http\Route;

$route = new Route;

$middleware = new Middleware;
$route->middleware(['jwt'])->group(function() {
    Route::get('/', 'HomeController@index');
    Route::get('/client', 'ClientController@index');
    Route::get('/client/{id}', 'ClientController@show'); 
});
Route::post('/client', 'ClientController@store');
Route::put('/client/{id}', 'ClientController@update');
Route::post('/login', 'LoginController@login');
