<?php

namespace App\Console\Commands\Devpanel;

use Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateCRUDSpecFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:generate-crud-spec-file
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

        File::copy($spec_dir . 'example-spec.json', $spec_file_entity);

        $this->line('Following spec file has been generated, it can be modified further and CRUD can be regenerated using the "project:generate-crud-from-file" command');
        $this->line($spec_file_entity);

        return 0;

    }
}
