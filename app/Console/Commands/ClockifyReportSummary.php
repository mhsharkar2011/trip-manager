<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Clockify\ClockifyService;

class ClockifyReportSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '
        project:clockify-report-summary
        {sub-days=0 : How of many number of days back you want to go.}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes Clockify report summary API call';

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
        
        $subDays = $this->argument('sub-days');

        $start = now('Asia/Dhaka')->subDay($subDays)->startOfDay()->toDateTimeLocalString();
        $end = now('Asia/Dhaka')->subDay($subDays)->endOfDay()->toDateTimeLocalString();

        // dd([compact('start', 'end')]);

        $summary_report = ClockifyService::summary_report($start, $end);

        if (! is_array($summary_report['groupOne'])) {
            exit('no entries found');
        }        

        $i = 1;
        $users_sorted = collect($summary_report['groupOne'])
        ->sortByDesc('duration')->map(function($row) use (&$i) {
            $row['name_raw'] = $row['name'];
            $row['name'] =  $i++ .'. '. $row['name'];
            $row['duration_humazined'] =  gmdate('H\h i\m', $row['duration']);
            return $row;
        });

        $users_sorted_output = $users_sorted->map(function($row) {
            return collect($row)->only(['name', 'duration_humazined']);
        });
    
    
        //find users who don't have entries
        $users_all = ClockifyService::get_all_active_users();

        $users_all_names = collect($users_all)->pluck('name');
        $users_without_entries = $users_all_names->diff($users_sorted->pluck('name_raw'))->values();

        $i = 1;
        $users_without_entries_arr = $users_without_entries->map(function($item) use (&$i) {
            return ['name' => $i++ .'. '. $item];
        })->toArray();
        //END - find users who don't have entries

        $this->table(
            ['Start', 'End'],
            [compact('start', 'end')]
        );
        
        $this->table(
            ['Name', 'Duration'],
            $users_sorted_output->toArray()
        );

        $this->line('');
        $this->line('-------------------------------');
        $this->line('Following users have no entries');

        $this->table(
            ['Name'],
            $users_without_entries_arr
        );
        
        return 0;
    }
}
