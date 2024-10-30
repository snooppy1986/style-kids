<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Imports\CategoriesImport;
use App\Imports\ProductsImport;
use App\Jobs\ImportProducts;
use App\Models\Product;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Log;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;
use Maatwebsite\Excel\Facades\Excel;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('ImportProducts')
                ->label('Импорт продуктов')
                ->color('danger')
                ->form([
                    FileUpload::make('attachment')
                        ->label('Файл')
                        ->directory('tmp')
                ])
                ->action(function (array $data){
                    Notification::make()
                        ->title('Импорт товаров запущен.')
                        ->success()
                        ->send();

                    Excel::queueImport(new ProductsImport, public_path('storage/'.$data['attachment']));

                })


        ];
    }
}
