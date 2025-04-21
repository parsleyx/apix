<?php

namespace App\Filament\Resources\AgentReportByMonthResource\Pages;

use App\Filament\Resources\AgentReportByMonthResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Carbon;

class EditAgentReportByMonth extends EditRecord
{
    protected static string $resource = AgentReportByMonthResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $startedAt = new Carbon($data['started_at']);
        $endedAt = new Carbon($data['started_at']);
        $data['started_at'] = $startedAt->startOfMonth()->format('Y-m-d H:i:s');
        $data['ended_at'] = $endedAt->endOfMonth()->format('Y-m-d H:i:s');
        return $data;
    }
}
