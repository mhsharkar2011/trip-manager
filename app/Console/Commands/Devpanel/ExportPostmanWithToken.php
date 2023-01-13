<?php

namespace App\Console\Commands\Devpanel;

use Artisan;
use File;
use Storage;
use Illuminate\Console\Command;

class ExportPostmanWithToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:export-postman-with-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a postman export with token and returns the public url so that can be imported from Postman from Link tab';

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
        /**
         $command = 'export:postman';
         
         if ($token = __getTokenForPostman()) {
             $command .= " --bearer={$token}";
            }
        */

        $command = 'postman:collection:export postman --api --url=' . env('APP_URL');
        
        if (Artisan::call($command) === 0) { //0=success
            // $file = str_replace('Postman Collection Exported: ', '', trim(Artisan::output())); //Postman Collection Exported: postman/2021_03_24_130458_laravel_collection.json
            $file = str_replace('Routes exported as postman collection! Filename: ', '', trim(Artisan::output())); //Routes exported as postman collection! Filename: 2021_04_21_201555_NameForCollection_api.json
            
            if (Storage::exists($file)) {
                $filename = basename($file);
                File::move(storage_path('app/' . $file), $filename);
                
                $this->line(url($filename));
                
                return 0;
            }
        }

        return 1; //error
        
    }
}
