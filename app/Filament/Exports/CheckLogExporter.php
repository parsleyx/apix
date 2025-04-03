<?php

namespace App\Filament\Exports;

use App\Models\CheckLog;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Database\Eloquent\Builder;

class CheckLogExporter extends Exporter
{
    protected static ?string $model = CheckLog::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('model'),
            ExportColumn::make('os_version'),
            ExportColumn::make('uuid'),
            ExportColumn::make('permissions'),
            ExportColumn::make('channel.name'),
            ExportColumn::make('package_name'),
            ExportColumn::make('channel_status'),
            ExportColumn::make('ad_id'),
            ExportColumn::make('ad_status'),
            ExportColumn::make('model_status'),
            ExportColumn::make('permission_status'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your check log export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
    public static function modifyQuery(Builder $query): Builder
    {
        return $query->latest('created_at')->limit(10000);
    }
}
