<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{ 
    protected function getStats(): array
    {
        return [
            Stat::make('Total Patient', Patient::count()),
        ];
    }
}
