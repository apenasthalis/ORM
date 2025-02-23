<?php 

require_once "../vendor/autoload.php";
require_once "./routes/api.php";

use Pericao\Orm\Core\Core;
use Pericao\Orm\Models\Client;
use Pericao\Orm\Http\Route;

Core::dispatch(Route::getRoutes());
