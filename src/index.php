<?php 

require_once "../vendor/autoload.php";
require_once "./routes/api.php";

use Pericao\Orm\Core\Core;
use Pericao\Orm\Http\Vault\Vault;
use Pericao\Orm\Http\Route;
use Pericao\Orm\Messaging\Consumer\MessageConsumer;
use Pericao\Orm\Messaging\Producer\MessageProducer;

// Core::dispatch(Route::getRoutes());

// $vault = new Vault();
// $dados = $vault->init();

$producer = new MessageProducer();
$producer->send('fila_teste', 'Teste de alta qualidade!');

$consumer = new MessageConsumer();

$consumer->consume('fila_teste', function ($msg) {
    echo "Recebido: " . $msg->body . "\n";
});