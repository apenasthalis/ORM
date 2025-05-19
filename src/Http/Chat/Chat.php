<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require dirname(__DIR__) . '/vendor/autoload.php';

class Chat implements MessageComponentInterface {
    public function onOpen(ConnectionInterface $conn) {
        echo "Nova conexão: {$conn->resourceId}\n";
    }
    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Mensagem recebida: $msg\n";
        $from->send("Você disse: $msg");
    }
    public function onClose(ConnectionInterface $conn) {
        echo "Conexão fechada: {$conn->resourceId}\n";
    }
    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Erro: {$e->getMessage()}\n";
        $conn->close();
    }
}

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);

echo "Servidor WebSocket rodando na porta 8080\n";
$server->run();
