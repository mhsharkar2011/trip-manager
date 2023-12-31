<?php

namespace App\Console\Commands;

use App\Services\Clockify\ClockifyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ClockifyHourLogsSendToRocketChatCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '
        project:clockify-hours-send-to-rocket-chat
        {--type=daily : "week" or "month", default is "daily" which need to be mentioned}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $report_type = $this->option('type');
        
        //type=daily
        $day_of_week = strtolower(now('Asia/Dhaka')->englishDayOfWeek);

        // $day_of_week = 'thursday'; //test
        
        //don't post anything on weekend
        if (in_array($day_of_week, ['saturday', 'sunday'])) {
            return 0;
        }

        $start_dt = now('Asia/Dhaka')->subDay(1);
        $start = now('Asia/Dhaka')->subDay(1)->startOfDay()->toDateTimeLocalString();
        $end = now('Asia/Dhaka')->subDay(1)->endOfDay()->toDateTimeLocalString();

        if ($day_of_week === 'monday') { //for monday we need hours of Friday
            $start_dt = now('Asia/Dhaka')->subDay(3);
            $start = now('Asia/Dhaka')->subDay(3)->startOfDay()->toDateTimeLocalString();
            $end = now('Asia/Dhaka')->subDay(3)->endOfDay()->toDateTimeLocalString();
        }
        
        $date = $start_dt->format('M j (l)'); //Dec 20 (Tuesday)

        if ('week' == $report_type) {
            $start_dt = now('Asia/Dhaka')->subWeek(1);
            $start = now('Asia/Dhaka')->subWeek(1)->startOfWeek()->toDateTimeLocalString();
            
            $end_dt = now('Asia/Dhaka')->subWeek(1)->endOfWeek();
            $end = now('Asia/Dhaka')->subWeek(1)->endOfWeek()->toDateTimeLocalString();

            $date = 'Week - ' . $start_dt->format('M j (l)') . ' - ' . $end_dt->format('M j (l)'); 
        } 

        if ('month' == $report_type) {
            $start_dt = now('Asia/Dhaka')->startOfMonth();
            $start = now('Asia/Dhaka')->startOfMonth()->toDateTimeLocalString();
            
            $end_dt = now('Asia/Dhaka')->endOfMonth();
            $end = now('Asia/Dhaka')->endOfMonth()->toDateTimeLocalString();

            $date = 'Month ' . $start_dt->format('M j') . ' - ' . now()->format('M j'); 
        } 

        $summary_report = ClockifyService::summary_report($start, $end);

        $msg = '';
        if (! is_array($summary_report['groupOne'])) {
            $msg = 'No entries found';
        }   

        $i = 1;
        $users_sorted = collect($summary_report['groupOne'])
        ->sortByDesc('duration')->map(function($row) use (&$i) {
            $row['name_raw'] = $row['name'];
            $row['name'] =  $i++ .'. '. $row['name'];
            // $row['duration_humazined'] =  \Carbon\CarbonInterval::seconds($row['duration'])->cascade()->forHumans(null, true, 2);
            $row['duration_humazined'] =  sprintf('%1dh %1dm', ($row['duration']/3600),($row['duration']/60%60));
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

        $msg = view('clockfiy-hours-rocket-chat', [
            'date' => $date,
            'users' => $users_sorted_output->toArray(),
            'users_without_entries_arr' => $users_without_entries_arr,
        ])->render();

        // logger($msg);

        // echo($msg);
        
        Artisan::call('project:send-rocket-chat-message', ['message' => $msg]);

        
        return 0;
    }
}
