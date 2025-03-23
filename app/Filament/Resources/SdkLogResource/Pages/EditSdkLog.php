<?php

namespace App\Filament\Resources\SdkLogResource\Pages;

use App\Filament\Resources\SdkLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSdkLog extends EditRecord
{
    protected static string $resource = SdkLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
