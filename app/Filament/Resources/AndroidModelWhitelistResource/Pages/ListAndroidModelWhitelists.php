<?php

namespace App\Filament\Resources\AndroidModelWhitelistResource\Pages;

use App\Filament\Resources\AndroidModelWhitelistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAndroidModelWhitelists extends ListRecords
{
    protected static string $resource = AndroidModelWhitelistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
