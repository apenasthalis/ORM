<?php
namespace Pericao\Orm\Messaging\Producer;

use Pericao\Orm\Messaging\Connection\RabbitMQConnection;
use PhpAmqpLib\Message\AMQPMessage;

class MessageProducer
{
    public function send(string $queue, string $message): void
    {
        $connection = RabbitMQConnection::getConnection();
        $channel = $connection->channel();

        $channel->queue_declare($queue, false, true, false, false);

        $msg = new AMQPMessage($message, [
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
        ]);

        $channel->basic_publish($msg, '', $queue);

        echo "📤 Mensagem enviada para '{$queue}': {$message}\n";

        $channel->close();
    }
}
