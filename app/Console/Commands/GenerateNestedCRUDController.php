<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateNestedCRUDController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '
    project:generate-nested-crud-controller
    {model : Enter the name of the model for the controller, e.g., Project}
    {parent_model : Enter the name of the parent model, e.g., Task}
';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a nested CRUD controller following boilerplate template';

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
        $model = $this->argument('model');
        $parent_model = $this->argument('parent_model');
        $parentController = \Str::studly($parent_model).\Str::studly($model) . 'Controller';

        $this->call('make:controller', [
            'name' => $parentController
            ,'--api' => 1
            ,'--type' => 'nested'
            ,'--model' => $this->argument('model')
            ,'--parent' => $this->argument('parent_model')
            ,'--force' => 1
        ]);  
        return 0;
        
    }
}
