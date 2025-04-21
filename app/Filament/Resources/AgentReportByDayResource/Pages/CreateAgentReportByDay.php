<?php

namespace App\Filament\Resources\AgentReportByDayResource\Pages;

use App\Filament\Resources\AgentReportByDayResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Carbon;

class CreateAgentReportByDay extends CreateRecord
{
    protected static string $resource = AgentReportByDayResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $startedAt = new Carbon($data["started_at"]);
        $endedAt = new Carbon($data["started_at"]);
        $data["started_at"] =$startedAt->startOfDay()->format('Y-m-d H:i:s');
        $data["ended_at"] = $endedAt->endOfDay()->format('Y-m-d H:i:s');
        return $data;
    }
}
