<?php

namespace App\Listeners;

use App\Events\RabbitMQMessageReceived;
use App\Models\RabbitmqEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RabbitMQMessageSaveInDB
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
    public function handle(RabbitMQMessageReceived $event)
    {
        $routing_key = $event->routing_key ?? null;
        $data = $event->data ?? null;

        try {
            RabbitmqEvent::createQuietly([ //supress eloquent created event which would publish to rabbitmq
                'routing_key' => $routing_key,
                'message' => $data,
            ]);
          } catch(\Exception $ex) {
            logger('In RabbitMQMessageSaveInDB, saving to DB failed, error: ' . $ex->getMessage()) ;
          }

        return true;
    }
}
