<?php

namespace App\Filament\Widgets;

use App\Models\AgentReportByDay;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AgentReportWidget extends BaseWidget
{
    protected ?string $heading = "数据统计";
    protected function getStats(): array
    {
        $user = auth()->user();

        $show = 0;
        $money =0;
        if($user->role != 'admin'){
            $packageIds = auth()->user()->packages->pluck('id')->toArray();
            $show = AgentReportByDay::whereIn('package_id',$packageIds)->sum('show');
            $money = AgentReportByDay::whereIn('package_id',$packageIds)->sum('money');
        }else{
            $show = AgentReportByDay::sum('show');
            $money = AgentReportByDay::sum('money');
        }
        return [
            Stat::make('总展现', $show),
            Stat::make('总收益',$money ),
        ];
    }
}
