<?php

namespace App\Filament\Resources\AgentResource\Pages;

use App\Filament\Resources\AgentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAgent extends CreateRecord
{
    protected static string $resource = AgentResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data["role"] = 'agent';
        return $data;
    }
}
