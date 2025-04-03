<?php

namespace App\Filament\Resources\SdkLogResource\Pages;

use App\Filament\Exports\SdkLogExporter;
use App\Filament\Resources\SdkLogResource;
use Filament\Actions;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Resources\Pages\ListRecords;

class ListSdkLogs extends ListRecords
{
    protected static string $resource = SdkLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Actions\ExportAction::make()->exporter(SdkLogExporter::class)->formats([
                ExportFormat::Xlsx,
            ])
            ->chunkSize(10000)
            ->fileDisk('public'),
        ];
    }
}
