<?php

namespace App\Filament\Resources\BeauticianResource\Pages;

use App\Filament\Resources\BeauticianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBeauticians extends ListRecords
{
    protected static string $resource = BeauticianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
