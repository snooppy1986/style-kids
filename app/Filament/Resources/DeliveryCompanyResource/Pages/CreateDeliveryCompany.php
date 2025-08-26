<?php

namespace App\Filament\Resources\DeliveryCompanyResource\Pages;

use App\Filament\Resources\DeliveryCompanyResource;
use App\Jobs\UpdateNewMailInformation;
use App\Models\User;
use App\Notifications\SuccessNotification;
use App\Traits\RedirectIndex;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDeliveryCompany extends CreateRecord
{
    use RedirectIndex;
    protected static string $resource = DeliveryCompanyResource::class;

    protected function afterCreate()
    {
        if($this->record->api_key && $this->record->name == 'new_mail'){
            dispatch(new UpdateNewMailInformation($this->record->api_key));
            User::query()->first()->notify(
                new SuccessNotification(
                    'Адресса новой почты обновлены.',
                    'heroicon-o-document-arrow-down',
                    '',
                    'admin/'
                )
            );
        }

        /*dd('after action', $this->record->api_key);*/
        /*This is where we need to trigger our event.*/
    }


}
