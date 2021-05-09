<?php

namespace App\Console\Commands\Devpanel;

use Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;

class GenerateCRUDCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:generate-crud
                            {entity_name : Enter the Label/name to be shown e.g., Users}
                            {fields : <field_name>#<field_type>; e.g., first_name#string; about_me#text}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates migration (and db table), model, Api Controller';

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
        $commandArg = [];
        $commandArg['name'] = \Str::remove(' ', $this->argument('entity_name'));

        $commandArg['--fields'] = $this->argument('fields');
        $commandArg['--controller-namespace'] = 'App\Http\Controllers';

        try {
            Artisan::call('crud:api', $commandArg);
            $this->line(Artisan::output());

            Artisan::call('migrate');
            $this->line(Artisan::output());
            return 1;
        } catch (\Exception $e) {
            $this->line($e->getMessage());
        }

        return 1;

    }
}
