<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class OrdersCountChart extends ChartWidget
{
    protected static ?string $pollingInterval = null;
    protected static ?string $heading = 'Заказы за месяц';
    protected static string $color = 'info';
    public ?string $filter = 'today';
    protected int | string | array $columnSpan = 'full';
    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $data = Trend::model(Order::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfDay(),
        )
            ->perDay()
            ->count();
        return [
            'datasets' => [
                [
                    'label' => 'Заказы',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    /*protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }*/
}
