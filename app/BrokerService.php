<?php

namespace App;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class BrokerService {

    protected static $connection;
    protected static $channel;
    protected const exchange = 'main';

    public static function init()
    {
        if (static::$connection === null) {
            static::$connection  = new AMQPStreamConnection('localhost', 5672, 'admin', 'secret');
            static::$channel = static::$connection->channel();
            static::$channel->exchange_declare(static::exchange, 'topic', false, false, false);
        }
    }

    public static function receive($routing_key, $callback)
    {
        static::init();
        
        $queue_name = sprintf('%s-%s', config('app.name'), $routing_key);

        static::$channel->queue_declare(
            $queue = $queue_name,
            $passive = false,
            $durable = true,
            $exclusive = false,
            $auto_delete = false,
            $nowait = false,
            $arguments = array(),
            $ticket = null
        );
        static::$channel->queue_bind($queue_name, static::exchange, $routing_key);

        logger('brokerService receive', compact('routing_key'));

        static::$channel->basic_consume($queue_name, '', false, false, false, false, $callback);
        
        while (static::$channel->is_open()) {
            static::$channel->wait();
        }
        static::$channel->close();
        static::$connection->close();     
    }

    public static function send($routing_key, Array $msgArray)
    {
        static::init();

        $msg = new AMQPMessage(json_encode($msgArray));

        logger('brokerService send', compact('routing_key', 'msgArray'));
    
        static::$channel->basic_publish($msg, 'main', $routing_key);
    
        static::$channel->close();
        static::$connection->close();     
    }

}