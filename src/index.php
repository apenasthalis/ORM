<?php 

require_once "../vendor/autoload.php";
require_once "./routes/api.php";

use Pericao\Orm\Core\Core;
use Pericao\Orm\Models\Client;
use Pericao\Orm\Http\Route;

Core::dispatch(Route::getRoutes());


// $user = new Client();
// $user->find(1);
// echo $user->name; // Exibe o nome do usuário com ID 1

$newUser = new Client();
$newUser->name = 'John Doe';
$newUser->email = 'john@example.com';
$newUser->save(); 