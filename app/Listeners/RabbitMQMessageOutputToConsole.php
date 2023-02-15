<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RabbitMQMessageOutputToConsole
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $msg = 'Received message from RabbitMQ: (RoutingKey: %s) Data: %s';

        $routing_key = $event->routing_key ?? null;
        $data = $event->data ?? null;

        $msg = sprintf($msg, $routing_key, $data);

        $msg .= PHP_EOL . 'Data converted to array: ' . PHP_EOL;
        $msg .= print_r(json_decode($data, true, JSON_PRETTY_PRINT), true);

        echo $msg;

        return true;
    }
}
