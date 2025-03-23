<?php

namespace App\Filament\Resources\CheckLogResource\Pages;

use App\Filament\Resources\CheckLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCheckLogs extends ListRecords
{
    protected static string $resource = CheckLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
