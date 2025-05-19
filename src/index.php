<?php 

require_once "../vendor/autoload.php";
require_once "./routes/api.php";

use Pericao\Orm\Core\Core;
use Pericao\Orm\Http\Vault\Vault;
use Pericao\Orm\Http\Route;

Core::dispatch(Route::getRoutes());

$vault = new Vault();
$dados = $vault->init();