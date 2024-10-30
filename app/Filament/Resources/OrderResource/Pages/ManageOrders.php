<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;

class ManageOrders extends ManageRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('Все'),
            'new' => Tab::make('Новые')->query(fn ($query) => $query->where('status', 'new')),
            'processing' => Tab::make('Принятые')->query(fn ($query) => $query->where('status', 'processing')),
            'shipped' => Tab::make('Отправленные')->query(fn ($query) => $query->where('status', 'shipped')),
            'delivered' => Tab::make('Доставленные')->query(fn ($query) => $query->where('status', 'delivered')),
            'cancelled' => Tab::make('Отменённые')->query(fn ($query) => $query->where('status', 'cancelled')),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class
        ];
    }
}
