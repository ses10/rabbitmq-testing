<?php

//autoloads 3rd party code. DUH
require_once __DIR__ . '/vendor/autoload.php';

//include necessary classes
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

//create a new connection to server
  //here we connect to a message broker on our machine, diff machine diff IP
$conn = new AMQPStreamConnection('127.0.0.1', 5672, 'test', 'test');

$channel = $connection->channel(); //Create a Channel



