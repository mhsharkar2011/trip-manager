<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Psy\CodeCleaner\AssignThisVariablePass;

class BackupPasswordColumn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:backup-password-column {backup_column_name=password_backup}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a backup password column, useful before running project:reset-all-passwords';

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
        $pwd_col = $this->argument('backup_column_name');
        
        $this->line($pwd_col);

        if (
            Schema::hasTable('users')
            && ! Schema::hasColumn('users', $pwd_col)
        ) {
            Schema::table('users', function($table) use ($pwd_col) {
                $table->string($pwd_col);
            });
        }

        $result = DB::statement("update users set $pwd_col=password;");
        
        $this->comment('All users\' password have been updated');
        
        return 0;
    }
}
