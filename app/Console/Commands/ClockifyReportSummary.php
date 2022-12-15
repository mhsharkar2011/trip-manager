<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

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

        $ClockifyReportHttp = app('Clockify\Report\Http');

        $response = $ClockifyReportHttp->post('/summary', [            
            'dateRangeStart' => $start,
            'dateRangeEnd' => $end,
            "summaryFilter" => [
                "groups" =>  [
                    'USER',
                    // 'CLIENT',
                    // 'PROJECT',
                    // 'TASK',
                    // 'DATE',
                    // 'TIMEENTRY',
                ],
                'sortColumn' => 'DURATION',
                'rounding' => true,
            ],        
            'detailedFilter' => [
                "page" =>  1,
                "pageSize" => 1000,
            ],
            // "billable" => true,
            // "billable" => false,
            "timeZone" => "Asia/Dhaka",
            // "withoutDescription" => false,
            "users" => [
                "ids" => [
                    // "5c495a66b079873e19e4b156", //reza
                    // "5c5d31b6b079871c5191f064", //rony
                    // "60d9560cd1e90c5de0b45f70", //mahmuda
                    // "612f09c1c78ce1665195b2e6", //samiul
                    // "5f0bd4c68c4563002b62bedd", //taushif
                    // "60f177eb5e6d0d0c1921af61", //sabiya
                    // "5c5d315cb079871c5191eee8", //tarif
                ],
                "status" => "ACTIVE"
            ],        
        ]);

        $data = $response->json();

        if (! is_array($data['groupOne'])) {
            exit('no entries found');
        }        

        $i = 1;
        $users_sorted = collect($data['groupOne'])
        ->sortByDesc('duration')->map(function($row) use (&$i) {
            $row['name_raw'] = $row['name'];
            $row['name'] =  $i++ .'. '. $row['name'];
            $row['duration_humazined'] =  gmdate('H\h i\m', $row['duration']);
            return $row;
        });

        $users_sorted_output = $users_sorted->map(function($row) {
            return collect($row)->only(['name', 'duration_humazined']);
        });
    
    //    dd($users_sorted_output);       
    
        //find users who don't have entries
        $clockifyHttp = app('Clockify\Http');
        $response_users = $clockifyHttp->get('/users?status=ACTIVE');
        $users_all = $response_users->json();

        $users_all_names = collect($users_all)->pluck('name');
        $users_without_entries = $users_all_names->diff($users_sorted->pluck('name_raw'))->values();

        // dd($users_sorted->pluck('name_raw')->values());

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
