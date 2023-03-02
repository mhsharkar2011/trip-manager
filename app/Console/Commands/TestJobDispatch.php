<?php

namespace App\Console\Commands;

use App\Jobs\TestJobLogInFile;
use Illuminate\Console\Command;
use Psy\CodeCleaner\AssignThisVariablePass;

class TestJobDispatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:job-test-dispatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatches a test job to test queue workers';

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
        TestJobLogInFile::dispatch();
        
        $this->comment('TestJobLogInFile job has been dispatched!');

        return 0;
    }
}
