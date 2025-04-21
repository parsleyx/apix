<?php

namespace App\Filament\Resources\AgentReportByMonthResource\Pages;

use App\Filament\Resources\AgentReportByMonthResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgentReportByMonths extends ListRecords
{
    protected static string $resource = AgentReportByMonthResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
