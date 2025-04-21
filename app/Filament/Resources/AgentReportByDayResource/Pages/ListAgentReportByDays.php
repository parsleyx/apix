<?php

namespace App\Filament\Resources\AgentReportByDayResource\Pages;

use App\Filament\Resources\AgentReportByDayResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgentReportByDays extends ListRecords
{
    protected static string $resource = AgentReportByDayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
