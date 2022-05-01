<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Products', Product::query()->count()),
            Card::make('Total Categories', Category::query()->count()),
            Card::make('Total Orders', Order::query()->count())
                ->description('Canceled: ' . Order::where('status', 'canceled')->count())->color('danger'),

        ];
    }
}