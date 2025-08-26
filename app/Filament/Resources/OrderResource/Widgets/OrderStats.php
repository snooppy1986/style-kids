<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Filament\Resources\OrderResource\Pages\ManageOrders;
use App\Models\Order;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class OrderStats extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;


    protected function getTablePage(): string
    {
        return ManageOrders::class;
    }

    protected function getStats(): array
    {
        $orderData = Trend::model(Order::class)
            ->between(
                start: now()->subYear(),
                end: now()
            )
            ->perYear()
            ->count();
        return [
            Stat::make('Всего заказов', $this->getPageTableQuery()->count())
                ->color('success')
                ->chart(
                    $orderData
                        ->map(fn(TrendValue $value) => $value->aggregate)
                        ->toArray()
                ),

            Stat::make('Средняя стоимость заказов', number_format($this->getPageTableQuery()->avg('total_price'), 2)),
        ];
    }
}
