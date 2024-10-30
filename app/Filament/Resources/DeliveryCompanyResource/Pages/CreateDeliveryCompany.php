<?php

namespace App\Filament\Resources\DeliveryCompanyResource\Pages;

use App\Filament\Resources\DeliveryCompanyResource;
use App\Jobs\UpdateNewMailInformation;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeliveryCompany extends CreateRecord
{
    protected static string $resource = DeliveryCompanyResource::class;

    protected function afterCreate()
    {
        dispatch(new UpdateNewMailInformation(api_key: $this->record->api_key));
        /*dd('after action', $this->record->api_key);*/
        /*This is where we need to trigger our event.*/
    }
}
