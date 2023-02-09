<?php

namespace App\Services\Clockify;

class ClockifyService {
    
    public static function get_all_active_users() {
        $clockifyHttp = app('Clockify\Http');
        return $clockifyHttp->get('/users?status=ACTIVE')->json();
    }    
    
    public static function summary_report($start_date, $end_date) {
        $ClockifyReportHttp = app('Clockify\Report\Http');

        $response = $ClockifyReportHttp->post('/summary', [            
            'dateRangeStart' => $start_date,
            'dateRangeEnd' => $end_date,
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
        ])->json();

        return $response;
    }




}