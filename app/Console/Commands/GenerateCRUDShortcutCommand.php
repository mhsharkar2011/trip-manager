<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateCRUDShortcutCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:crud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A shortcut cmd to link between related crud commands';

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
        $choice_1 = 'Create a json spec file for CRUD';
        $choice_2 = 'Generete CRUD from a json spec file';
        $choice_3 = 'Generete quick CRUD';

        $commands = [
            $choice_1 => 'project:generate-crud-spec-file',
            $choice_2 => 'project:generate-crud-from-file',
            $choice_3 => 'project:generate-quick-crud',
        ];

        
        $selection = $this->choice('Which CRUD command are you looking for', [
            $choice_1,
            $choice_2,
            $choice_3,
        ]);
        

        $args = [];
        if (
            $selection === $choice_1
            || $selection === $choice_3
        ) {
            $r = $this->ask("What will be the entity name? example: 'Post' ");
            $args['entity_name'] = $r;
        }

        $this->call($commands[$selection], $args);
        
        return 0;
    }
}
