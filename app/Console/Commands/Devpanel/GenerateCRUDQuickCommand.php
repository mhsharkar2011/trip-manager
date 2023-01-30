<?php

namespace App\Console\Commands\Devpanel;

use Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateCRUDQuickCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:generate-quick-crud
                            {entity_name : Enter the Label/name for the entity e.g., Posts}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quickly generate migration (and db table), model, Api Controller with just one column.';

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
        
        $name = \Str::remove(' ', $this->argument('entity_name'));
        $commandArg['name'] = $name;

        
        $spec_dir = resource_path('views/devpanel/crud-generator/entity-schema/'); 
        $spec_file_entity =  $spec_dir . $name . '.json';

        $this->call('project:generate-crud-spec-file', [
            'entity_name' => $name
        ]);
        
        $commandArg['--fields_from_file'] = $spec_file_entity;
        $commandArg['--controller-namespace'] = 'App\Http\Controllers';


        try {
            Artisan::call('crud:api', $commandArg);
            $this->line(Artisan::output());
            
            $this->call('migrate:fresh', [
                '--force' => '',
                '--seed' => '',
            ]);
            
            return 0;
        } catch (\Exception $e) {
            $this->line($e->getMessage());
        }

        return 1;

    }
}
