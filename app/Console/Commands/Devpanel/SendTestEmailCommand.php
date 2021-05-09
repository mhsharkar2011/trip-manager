<?php

namespace App\Console\Commands\Devpanel;

use App\Models\User;
use Illuminate\Console\Command;

class SendTestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:send-test-email {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Useful in production to see if email smtp/other configuration is working properly, by 
    sending yourself an email';

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
        // logger($this->argument('email'));
        // return $this->argument('email');

        return \Notification::route('mail', $this->argument('email'))
                ->notify(new \App\Notifications\TestEmail);
    }
}
