<?php

namespace App;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService {

    protected static $connection;
    protected static $channel;
    protected const exchange = 'main';

    public static function init()
    {
        static::$connection  = new AMQPStreamConnection(
            config('services.rabbitmq.host'), 
            config('services.rabbitmq.port'), 
            config('services.rabbitmq.user'), 
            config('services.rabbitmq.password')
        );
        static::$channel = static::$connection->channel();
        static::$channel->exchange_declare(static::exchange, 'topic', false, false, false);
    }

    public static function consume($routing_key, $callback)
    {
        static::init();
        
        $routing_key = strtolower($routing_key);
        $queue_name = strtolower(sprintf('%s-%s', config('app.name'), $routing_key));

        static::$channel->queue_declare(
            $queue = $queue_name,
            $passive = false,
            $durable = true,
            $exclusive = false,
            $auto_delete = false, //default is true, set to false so that not auto deleted when there is no consumer
            $nowait = false,
            $arguments = array(),
            $ticket = null
        );
        static::$channel->queue_bind($queue_name, static::exchange, $routing_key);

        // logger('brokerService receive', compact('routing_key'));

        echo sprintf(" [*] Listening for events from RabbitMQ (Queue: %s, RoutingKey: %s). To exit press CTRL+C\n", $queue_name, $routing_key);

        static::$channel->basic_consume(
            $queue_name, 
            $consumer_tag = '', 
            $no_local = false, 
            $no_ack = false, //so we can manually ack
            $exclusive = false, 
            $nowait = false, 
            $callback
        );
        
        while (static::$channel->is_open()) {
            static::$channel->wait();
        }
        static::$channel->close();
        static::$connection->close();     
    }

    public static function publish($routing_key, Array $msgArray)
    {
        static::init();
        //todo: set the channel to publisher confirm mode, more in the doc
        /*
        $channel->confirm_select();
        $channel->set_nack_handler() {
            function (AMQPMessage $msg) {
                //publish msg again
            }
        }
        */

        $msg = new AMQPMessage(json_encode($msgArray));
        $routing_key = strtolower($routing_key);

        // logger('in brokerService publish', compact('routing_key', 'msgArray'));
    
        static::$channel->basic_publish($msg, 'main', $routing_key);
    
        static::$channel->close();
        static::$connection->close();     
    }

    public static function should_publish_eloquent_events() {
        return config('services.rabbitmq.auto_publish_eloquent_events');
    }

}