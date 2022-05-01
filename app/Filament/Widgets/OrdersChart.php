<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;

class OrdersChart extends LineChartWidget
{
    protected static ?string $heading = 'Orders Stats';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}