<?php

namespace App\Console\Commands;

use App\BrokerService;
use Illuminate\Console\Command;


class BrokerEventListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:receive-event';

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

        $routing_key = '#'; //todo - parameterize
        $callback = function ($msg) {
            logger('received event from broker: ' . $msg->delivery_info['routing_key'], (array)$msg->body);
            $msg->ack();
        };


        BrokerService::receive(
            $routing_key,
            $callback
        );


        
        return 0;
    }
}
