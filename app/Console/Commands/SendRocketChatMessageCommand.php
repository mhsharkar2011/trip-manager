<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendRocketChatMessageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '
        project:send-rocket-chat-message
        {message}
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
        
        $message = $this->argument('message');

        $response = Http::withHeaders([
            'X-Auth-Token' => env('ROCKETCHAT_TOKEN'),
            'X-User-Id' => env('ROCKETCHAT_FROM_USER_ID'),
            'Accept' =>'application/json',
        ])
        ->post('https://chat.sandbox3000.com/api/v1/chat.postMessage', [
            'channel' => '#i-time-police',
            'roomId' => 'JtAE8eyQkCB6dbL3c',
            'text' => $message,
            'emoji' => ':timer:',
        ])
        ->json();

        $this->line(json_encode($response, JSON_PRETTY_PRINT));
        
        return 0;
    }
}
