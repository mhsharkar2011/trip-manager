<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Psy\CodeCleaner\AssignThisVariablePass;

class ResetAllPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:reset-all-passwords {new_password=123456}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets all user passwords to the supplied password';

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
        // $this->call('project:backup-password-column');

        if (app()->environment() === 'production') {
            return $this->error('You cannot run this command in production mode!');
        }

        $query = sprintf("update users set password='%s'", bcrypt($this->argument('new_password')));

        $this->comment('Running the following query');
        $this->line('update users set password=' . bcrypt($this->argument('new_password')));

        DB::statement($query);

        $this->comment('DONE!');

        return 0;
    }
}
