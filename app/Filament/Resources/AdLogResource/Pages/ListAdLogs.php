<?php

namespace App\Filament\Resources\AdLogResource\Pages;

use App\Filament\Exports\AdLogExporter;
use App\Filament\Resources\AdLogResource;
use Filament\Actions;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Resources\Pages\ListRecords;

class ListAdLogs extends ListRecords
{
    protected static string $resource = AdLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Actions\ExportAction::make()->exporter(AdLogExporter::class)->formats([
                ExportFormat::Xlsx,
            ])
            ->chunkSize(10000)
            ->fileDisk('public'),
        ];
    }
}
