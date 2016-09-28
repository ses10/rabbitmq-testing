<?php

//autoloads 3rd party code. DUH
require_once __DIR__ . '/vendor/autoload.php';

//include necessary classes
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

//create a new connection to server(connection object)
  //here we connect to a message broker on our machine, diff machine needs diff IP
$conn = new AMQPStreamConnection('127.0.0.1', 5672, 'test', 'test');

//Create a Channel(virtual connection inside the connection we made and is used to send and recieve messages)
$channel = $conn->channel(); 

//Declare a Queue(buffer for messages)
  //first param is name of queue, the rest are settings like "durable", "auto-delete", etc
$channel->queue_declare('hello', false, false, false, false);

//publish message to queue
$msg = new AMQPMessage('HI!');
$channel->basic_publish($msg, '', 'hello'); //@params : message, exchange, routing_key

echo " [x] Sent 'Hi!'\n";

//close channel and connection
$channel->close();
$connection->close();
