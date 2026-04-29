<?php

namespace App\Filament\Widgets;

use App\Models\Brand;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Variant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Brands', Brand::count())
                ->description('Active manufacturers')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('success'),
            Stat::make('Total Series', Collection::count())
                ->description('Product collections')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('primary'),
            Stat::make('Total Colors', Product::count())
                ->description('Individual product colors')
                ->descriptionIcon('heroicon-m-swatch')
                ->color('info'),
            Stat::make('Total SKUs', Variant::count())
                ->description('Color-Size variations')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),
        ];
    }
}
