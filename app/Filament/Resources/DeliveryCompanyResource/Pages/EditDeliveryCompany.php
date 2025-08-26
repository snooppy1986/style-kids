<?php

namespace App\Filament\Resources\DeliveryCompanyResource\Pages;

use App\Filament\Resources\DeliveryCompanyResource;
use App\Traits\RedirectIndex;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeliveryCompany extends EditRecord
{
    use RedirectIndex;
    protected static string $resource = DeliveryCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

}
