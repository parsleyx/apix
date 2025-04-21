<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AgentReportWidget;
use Filament\Pages\Page;

class AgentReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.agent-report';
    protected static ?string $navigationGroup = '数据报表';
    protected static ?string $navigationLabel = "报表";
    protected static ?string $title = "报表";
    protected function getHeaderWidgets(): array
{
    return [
        AgentReportWidget::make(),
    ];
}
}
