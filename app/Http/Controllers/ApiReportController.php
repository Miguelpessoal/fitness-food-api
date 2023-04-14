<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiReportController extends Controller
{
    public function __invoke()
    {
        $lastCronRun = file_get_contents(storage_path('app/cron-last-run'));

        $startTime = microtime(true);
        $startMemory = memory_get_usage();

        $uptime = microtime(true) - $startTime;
        $endMemory = memory_get_usage();
        $memoryUsage = $endMemory - $startMemory;

        return response()->json([
            'uptime' => $uptime,
            'memory' => $memoryUsage,
            'last_cron_run' => Carbon::parse($lastCronRun),
        ]);
    }
}
