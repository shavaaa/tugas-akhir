<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ServiceSchedule;
use Carbon\Carbon;

class UpdateExpiredSchedules extends Command
{
    protected $signature = 'schedules:expire';
    protected $description = 'Update service schedules that have already passed and mark them as expired.';

    public function handle()
    {
        $now = Carbon::now();

        ServiceSchedule::where('status', 'tersedia')
            ->where(function ($query) use ($now) {
                $query->whereDate('tanggal', '<', $now->toDateString())
                    ->orWhere(function ($subQuery) use ($now) {
                        $subQuery->whereDate('tanggal', $now->toDateString())
                            ->whereTime('waktu_selesai', '<', $now->toTimeString());
                    });
            })
            ->update(['status' => 'expired']);

        $this->info('Expired schedules updated.');
    }
}
