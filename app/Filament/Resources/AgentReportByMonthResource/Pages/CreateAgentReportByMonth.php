<?php

namespace App\Filament\Resources\AgentReportByMonthResource\Pages;

use App\Filament\Resources\AgentReportByMonthResource;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;

class CreateAgentReportByMonth extends CreateRecord
{
    protected static string $resource = AgentReportByMonthResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $startedAt = new Carbon($data['started_at']);
        $endedAt = new Carbon($data['started_at']);
        $data['started_at'] = $startedAt->startOfMonth()->format('Y-m-d H:i:s');
        $data['ended_at'] = $endedAt->endOfMonth()->format('Y-m-d H:i:s');
        return $data;
    }
}
