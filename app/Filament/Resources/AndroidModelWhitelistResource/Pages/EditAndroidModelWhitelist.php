<?php

namespace App\Filament\Resources\AndroidModelWhitelistResource\Pages;

use App\Filament\Resources\AndroidModelWhitelistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAndroidModelWhitelist extends EditRecord
{
    protected static string $resource = AndroidModelWhitelistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
