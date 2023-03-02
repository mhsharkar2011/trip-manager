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
            logger('in rabbitmq save event in db');
            RabbitmqEvent::withoutEvents(function() use ( //supress eloquent created event which would publish to rabbitmq
                $routing_key,
                $data
            ) {
                $r = RabbitmqEvent::create([ 
                    'routing_key' => $routing_key,
                    'message' => $data,
                ]);
                logger('saved data: ' . $r);
            });
          } catch(\Exception $ex) {
            logger('In RabbitMQMessageSaveInDB, saving to DB failed, error: ' . $ex->getMessage()) ;
          }

        return true;
    }
}
