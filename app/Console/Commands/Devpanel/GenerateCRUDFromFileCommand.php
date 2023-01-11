<?php

namespace App\Console\Commands\Devpanel;

use Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateCRUDFromFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:generate-crud-from-file
                            {file_path? : Enter the full path to the json file}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate migration (and db table), model, Api Controller from json spec file';

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
        
        // File::allFiles()
        $spec_dir = resource_path('views/devpanel/crud-generator/entity-schema/'); 
        $files = array_diff(scandir($spec_dir), array('.', '..', 'example-spec.json'));

        $file = $this->choice(
            'Choose a json file for the CRUD?',
            $files,
            null,
            $maxAttempts = null,
            $allowMultipleSelections = false
        );

        $entity_name = rtrim($file, '.json');

        
        $commandArg['name'] = $entity_name;
        $commandArg['--fields_from_file'] = $spec_dir . $file;

        try {
            Artisan::call('crud:api', $commandArg);
            $this->line(Artisan::output());

            $this->call('migrate', [
                '--force' => '',
                '--seed' => '',
            ]);
            
            return 1;
        } catch (\Exception $e) {
            $this->line($e->getMessage());
        }

        return 1;

    }
}
