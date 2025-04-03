<?php

namespace App\Filament\Resources\CheckLogResource\Pages;

use App\Filament\Exports\CheckLogExporter;
use App\Filament\Resources\CheckLogResource;
use Filament\Actions;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Resources\Pages\ListRecords;

class ListCheckLogs extends ListRecords
{
    protected static string $resource = CheckLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()->exporter(CheckLogExporter::class)->formats([
                ExportFormat::Xlsx,
            ])
            ->chunkSize(10000)
            ->fileDisk('public'),
            // Actions\CreateAction::make(),
        ];
    }
}
