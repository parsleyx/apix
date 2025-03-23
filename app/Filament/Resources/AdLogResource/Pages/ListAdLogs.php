<?php

namespace App\Filament\Resources\AdLogResource\Pages;

use App\Filament\Resources\AdLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdLogs extends ListRecords
{
    protected static string $resource = AdLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
