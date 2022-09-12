<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Components\LemonadeMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection(
    'rabbitMQ',
    5672,
    'highload',
    'Password@123',
);

try {
    $channel = $connection->channel();
    $channel->queue_declare('Lemonade', false, false, false, false);

    $msg = new AMQPMessage(json_encode(new LemonadeMessage('Coca-Cola', 1)));
    $channel->basic_publish($msg, '', 'Lemonade');

    $channel->close();
    $connection->close();
} catch (\PhpAmqpLib\Exception\AMQPProtocolChannelException | Exception $e) {
    echo $e->getMessage();
}
