<?php

namespace App\Filament\Resources\BeauticianResource\Pages;

use App\Filament\Resources\BeauticianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBeautician extends EditRecord
{
    protected static string $resource = BeauticianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
