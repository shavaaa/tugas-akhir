<?php

namespace App\Filament\Resources\OrderReviewResource\Pages;

use App\Filament\Resources\OrderReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrderReviews extends ListRecords
{
    protected static string $resource = OrderReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

