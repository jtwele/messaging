<?php

require_once __DIR__ . '/libs/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPConnection('141.22.29.97', 5672, 'invoiceSender', 'invoiceSender');

$channel = $connection->channel();
$channel->queue_declare('controllerInvoice', false, false, false, false);

for ($x = 0; $x <= 10; $x++) {

	$idx = $x;   // boolean
	settype($bar, "string");

    	echo "The number is: $x <br>";

	$msg = new AMQPMessage('nachricht: $bar <br>');

	$channel->basic_publish($msg, '', 'controllerInvoice');

	echo " [x] Sent 'Hello World!'\n";
}
$channel->close();
$connection->close();
?>
