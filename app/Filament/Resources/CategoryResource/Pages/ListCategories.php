<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Imports\CategoriesImport;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;


class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('ImportCategories')
                ->label('Импорт категорий')
                ->color('danger')
                ->form([
                    FileUpload::make('attachment')
                        ->label('Файл')
                        ->directory('tmp')
                ])
                ->action(function (array $data){
                    Notification::make()
                        ->title('Импорт категорий запущен.')
                        ->success()
                        ->send();

                    Excel::queueImport(new CategoriesImport, public_path('storage/'.$data['attachment']));
                })
        ];
    }
}
