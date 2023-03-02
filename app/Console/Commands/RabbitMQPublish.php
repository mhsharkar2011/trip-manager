<?php

namespace App\Console\Commands;

use App\RabbitMQService;
use Illuminate\Console\Command;

class RabbitMQPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:rabbitmq-publish
    {--R|routing-key= : Routing key for the message/event, format <app>.<entity>.<action> example pmapp.project.delete}
    {--D|data= : Data for the message/event, pass string or whatever, will be cast to an array which is fine for testing.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish a message to RabbitMQ broker, this command has to real use case other than for quick testing';

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
                Please enter the routing key for the message/event. Our usual format is <app>.<entity>.<action>, so an example for routing key would be,
                pmapp.project.delete  
            ');
        }

        $data = $this->option('data');

        if (! $data) {
            $data = $this->ask('
                Please enter the data for the message/event. Pass a PHP array.
            ');
        }

        RabbitMQService::publish($routing_key, (array) $data);
        
        $this->line('the message has been published');

        return 0;
    }
}
