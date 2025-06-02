<?php

namespace App\Filament\Resources\ServiceScheduleResource\Pages;

use App\Filament\Resources\ServiceScheduleResource;
use Illuminate\Validation\ValidationException;
use Filament\Resources\Pages\CreateRecord;
use App\Models\ServiceSchedule;
use Filament\Notifications\Notification;

class CreateServiceSchedule extends CreateRecord
{
    protected static string $resource = ServiceScheduleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Validasi jadwal tabrakan
        $exists = ServiceSchedule::where('tanggal', $data['tanggal'])
            ->where(function ($query) use ($data) {
                $query->whereBetween('waktu_mulai', [$data['waktu_mulai'], $data['waktu_selesai']])
                    ->orWhereBetween('waktu_selesai', [$data['waktu_mulai'], $data['waktu_selesai']])
                    ->orWhere(function ($query) use ($data) {
                        $query->where('waktu_mulai', '<=', $data['waktu_mulai'])
                            ->where('waktu_selesai', '>=', $data['waktu_selesai']);
                    });
            })
            ->exists();

        if ($exists) {
            Notification::make()
                ->title('Jadwal Bentrok')
                ->danger()
                ->body('Ada jadwal lain di tanggal & jam yang sama. Silakan pilih waktu lain.')
                ->send();

            // Tambahkan ini biar data ga masuk
            throw ValidationException::withMessages([
                'waktu_mulai' => 'Ada jadwal lain di tanggal & jam yang sama.',
            ]);
        }

        return $data;
    }
}
