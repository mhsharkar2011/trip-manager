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
        $key = config('clockify.api_key');
        $workspace_id = config('clockify.workspace_id');

        if (!$key || !$workspace_id) {
            $this->error('Clockify API key or Clockify workspace ID not found in config.');
            return 1;
        }
        
        $api_base = 'https://reports.api.clockify.me/v1/workspaces/' . $workspace_id . '/reports';
        
        $subDays = $this->argument('sub-days');

        $start = now('Asia/Dhaka')->subDay($subDays)->startOfDay()->toDateTimeLocalString();
        $end = now('Asia/Dhaka')->subDay($subDays)->endOfDay()->toDateTimeLocalString();

        // dd([compact('start', 'end')]);

        $response = Http::withHeaders([
            'X-Api-Key' => $key,
        ])->post($api_base . '/summary', [
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

        $users_sorted = collect($data['groupOne'])->sortByDesc('duration')->map(function($row) {
            $row['duration_humazined'] =  gmdate('H\h i\m', $row['duration']);
            return $row;
        });

        $users_sorted_output = $users_sorted->map(function($row) {
            return collect($row)->only(['name', 'duration_humazined']);
        })->toArray();
    
    //    dd($users_sorted_output);        

        $this->table(
            ['Start', 'End'],
            [compact('start', 'end')]
        );
        
        $this->table(
            ['Name', 'Duration'],
            $users_sorted_output
        );
        
        return 0;
    }
}
