<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateCRUDController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '
        project:generate-crud-controller
        {model : Enter the name of the model for the controller, e.g., User, Post, Project}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a CRUD controller following boilerplate template';

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
        $controller = \Str::studly($model) . 'Controller';

        $this->call('make:controller', [
            'name' => $controller
            ,'--api' => 1
            ,'--type' => 'model'
            ,'--model' => $this->argument('model')
            ,'--force' => 1
        ]);        

        return 0;
    }
}
