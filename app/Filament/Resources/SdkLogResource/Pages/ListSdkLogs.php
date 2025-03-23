<?php

namespace App\Filament\Resources\SdkLogResource\Pages;

use App\Filament\Resources\SdkLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSdkLogs extends ListRecords
{
    protected static string $resource = SdkLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
