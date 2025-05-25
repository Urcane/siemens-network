<?php

namespace App\Jobs;

use App\Notifications\DownAlertNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class DownAlertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $downtime_range_end = Carbon::now();

        $query = DB::connection('sqlsrv-2')->table('tbl_web_user_site_regions', 'user_site_regions')
                ->join('tbl_web_sites', 'tbl_web_sites.site_region_id', 'user_site_regions.site_region_id')
                ->join('tbl_snmp_com', 'tbl_snmp_com.ip', 'tbl_web_sites.ip')
                ->join('tbl_rtubatstat', 'tbl_web_sites.rtu_id', 'tbl_rtubatstat.rtu_id')
                ->where('user_site_regions.user_id', 1)
                ->orderBy('tbl_web_sites.id', 'ASC');

        Log::info($query->get());

        $query = $query->get()->map(function($item) use ($downtime_range_end) {
            if ($downtime_range_end->diffInMinutes(Carbon::parse($item->rxtime)) >= 10) {
                Notification::route('telegram', '-1001619179399')
                    ->notify(new DownAlertNotification($item));
            }

            $result = [
                "ip" => $item->ip,
                "status" => $downtime_range_end->diffInMinutes(Carbon::parse($item->rxtime)) >= 10,
            ];

            return $result;
        });

    }
}
