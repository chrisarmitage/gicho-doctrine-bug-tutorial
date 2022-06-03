<?php

namespace Application\Console;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class PushDataAmqp
{
    public function execute()
    {
        $connection = new AMQPStreamConnection(
            $_ENV['AMQP_HOST'],
            $_ENV['AMQP_PORT'],
            $_ENV['AMQP_USER'],
            $_ENV['AMQP_PASSWORD'],
            $_ENV['AMQP_VHOST'],
        );
        $channel = $connection->channel();
        $channel->queue_declare('amqp_test', false, false, false, false);

        for ($n = 1; $n <= 4; $n++) {
            $data = [
                'value'     => $n,
                'timestamp' => (new \DateTimeImmutable())->format('Y-m-d H:i:s')
            ];

            $message = new AMQPMessage(json_encode($data));
            $channel->basic_publish($message, '', 'amqp_test');
        }

        $channel->close();
        $connection->close();
    }
}
