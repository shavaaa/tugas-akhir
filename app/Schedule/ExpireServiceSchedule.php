<?php

namespace App\Schedule;

use Illuminate\Console\Scheduling\Schedule;

class ExpireServiceSchedule
{
    public function __invoke(Schedule $schedule)
    {
        $schedule->command('schedules:expire')->everyFiveMinutes();
    }
}
