<?php
namespace Pericao\Orm\Messaging\Consumer;

use Pericao\Orm\Messaging\Connection\RabbitMQConnection;

class MessageConsumer
{
    public function consume(string $queue, callable $callback): void
    {
        $connection = RabbitMQConnection::getConnection();
        $channel = $connection->channel();

        $channel->queue_declare($queue, false, true, false, false);

        echo "👂 Aguardando mensagens em '{$queue}'...\n";

        $channel->basic_consume($queue, '', false, true, false, false, $callback);

        while ($channel->is_open()) {
            $channel->wait();
        }
    }
}
