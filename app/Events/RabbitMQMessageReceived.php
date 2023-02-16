<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RabbitMQMessageReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $msg_raw;
    public $routing_key;
    public $data;

    public function should_publish_auto() {
        return false;
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg_raw = $msg;
        
        $this->routing_key = $msg->delivery_info['routing_key'] ?? null;
        $this->data = $msg->body ?? null;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
