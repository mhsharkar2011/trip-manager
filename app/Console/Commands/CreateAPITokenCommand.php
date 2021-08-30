<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAPITokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '
        project:create-api-token
        {email? : Should be an email of existing user for whom you want to create the token, if empty then the first user in database will be used}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a API token representing an user';

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
        $user = null;

        if ($email = $this->argument('email')) {
            $user = User::whereEmail($email)->first();
        } 
        
        if (! $user) {
            $user = User::first();
        }

        $token = $user->createToken($user->email)->plainTextToken;
        $this->line($token);
        // $this->line("Token created for user with email {$user->email}: {$token}");

        return 0;
    }
}
