<?php

namespace App\Console\Commands;

use App\Events\RabbitMQMessageReceived;
use App\RabbitMQService;
use Illuminate\Console\Command;


class RabbitMQConsume extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:rabbitmq-consume 
    {--R|routing-key= : Routing key for the queue, for routing key formats check "Topic exchange" seciton under https://www.rabbitmq.com/tutorials/tutorial-five-php.html}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $routing_key = $this->option('routing-key');

        if (! $routing_key) {
            $routing_key = $this->ask('
                Please enter the routing key for the queue. Our usual format is <app>.<entity>.<action>, so some examples for routing keys,
                # - listens for all events
                pmapp.project.* - listens for all pmapp project related events
                pmapp.# - listens for all pmapp related events
            ');
        }

        $callback = function ($msg) {
            RabbitMQMessageReceived::dispatch($msg);
            $msg->ack(); //todo: ack() in a try catch success
        };


        RabbitMQService::consume(
            $routing_key,
            $callback
        );
        
        return 0;
    }
}
