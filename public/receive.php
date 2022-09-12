<?php

require __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection(
    'rabbitMQ',
    5672,
    'highload',
    'Password@123'
);

try {
    $channel = $connection->channel();
    $channel->queue_declare('Lemonade', false, false, false, false);

    $msg = new AMQPMessage('Coca-Cola', 1);
    $channel->basic_publish($msg);

    echo " [*] Waiting for messages. To exit press CTRL+C\n";


    $callback = function ($msg) {
        echo ' [x] Received ', $msg->body, "\n";
    };

    $channel->basic_consume(
        'Lemonade',
        '',
        false,
        true,
        false,
        false,
        $callback
    );

    while ($channel->is_open()) {
        $channel->wait();
    }
} catch (\PhpAmqpLib\Exception\AMQPProtocolChannelException | Exception $e) {
    echo $e->getMessage();
}
