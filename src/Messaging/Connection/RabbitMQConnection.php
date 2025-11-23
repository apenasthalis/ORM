<?php
namespace Pericao\Orm\Messaging\Connection;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQConnection
{
    private static ?AMQPStreamConnection $connection = null;

    public static function getConnection(): AMQPStreamConnection
    {
        if (self::$connection === null) {
            self::$connection = new AMQPStreamConnection(
                'rabbitmq', // nome do container no docker-compose
                5672,
                'thalis',
                'fuck'
            );
        }
        return self::$connection;
    }
}
