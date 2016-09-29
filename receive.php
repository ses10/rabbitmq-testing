<?php

//autoloads 3rd party code. DUH
require_once __DIR__ . '/vendor/autoload.php';

//include necessary classes
use PhpAmqpLib\Connection\AMQPStreamConnection;

//setup is same as sender
//open connection and channel
$conn = new AMQPStreamConnection('127.0.0.1', 5672, 'test', 'test');
$channel = $conn->channel();

//then declare the queue that we will consume from
$channel->queue_declare('hello', false, false, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

//the callback for when channel recieves message
$callback = function($msg)
{
	echo " [x] Received ", $msg->body, "\n";
};

//start a queue consumer
$channel->basic_consume('hello', '', false, true, false, false, $callback);

//continue waiting while channel has callbacks
while(count($channel->callbacks))
{
	$channel->wait();
}
