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
        // 🧠 Hitung dulu waktu_selesai supaya bisa dipakai buat validasi bentrok
        if (!isset($data['waktu_selesai']) && isset($data['waktu_mulai'], $data['durasi'])) {
            $data['waktu_selesai'] = \Carbon\Carbon::parse($data['waktu_mulai'])
                ->addMinutes((int) $data['durasi'])
                ->format('H:i');
        }

        // 🔒 Validasi agar waktu_selesai tidak lewat dari 17:00
        $maxWaktu = \Carbon\Carbon::createFromTime(17, 0); // batas jam 17:00
        $selesai = \Carbon\Carbon::parse($data['waktu_selesai']);

        if ($selesai->gt($maxWaktu)) {
            Notification::make()
                ->title('Jam Tidak Valid')
                ->danger()
                ->body('Waktu selesai tidak boleh lebih dari jam 17:00.')
                ->send();

            throw ValidationException::withMessages([
                'waktu_mulai' => 'Waktu selesai tidak boleh lebih dari jam 17:00.',
            ]);
        }

        // ✅ Sekarang baru validasi bentrok
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

            throw ValidationException::withMessages([
                'waktu_mulai' => 'Ada jadwal lain di tanggal & jam yang sama.',
            ]);
        }

        return $data;
    }
}
