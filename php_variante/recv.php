<?php
require_once __DIR__ . '/libs/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;


#Default werte: 
# Username: guest
# password: guest
#
# Änderung (in der Konsole eingeben):
# rabbitmqctl delete_user guest 
# rabbitmqctl add_user ninja steffens => bedeutet, dass username = ninja und pw = steffens
#
#
#create connection
$connection = new AMQPConnection('141.22.29.97', '5672', 'invoice', 'invoice');// host = host auf dem der Broker läuft
$channel = $connection->channel();

#declaer messagequeue
$channel->queue_declare('invoice', false, false, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";


#wait for messages
$callback = function($msg) {
echo " [x] Received ", $msg->body, "\n";
};

$channel->basic_consume('invoice', '', false, true, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

#close connection
$channel->close();
$connection->close();
?>

