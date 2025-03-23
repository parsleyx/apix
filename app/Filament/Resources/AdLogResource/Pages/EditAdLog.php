<?php

namespace App\Filament\Resources\AdLogResource\Pages;

use App\Filament\Resources\AdLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdLog extends EditRecord
{
    protected static string $resource = AdLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
