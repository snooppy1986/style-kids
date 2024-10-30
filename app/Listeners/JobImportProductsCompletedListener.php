<?php

namespace App\Listeners;

use App\Events\JobImportProductsCompleted;
use App\Notifications\SuccessNotification;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
/*use Illuminate\Support\Facades\Notification;*/

class JobImportProductsCompletedListener implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public function handle(JobImportProductsCompleted $event): void
    {
        dump('import completed');

        /*Notification::make()
            ->title('Импорт завершен успешно.')
            ->danger()
            ->send();*/

    }
}
