<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyInfoResource\Pages;
use App\Filament\Resources\CompanyInfoResource\RelationManagers;
use App\Models\CompanyInfo;
use App\Models\Phone;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CompanyInfoResource extends Resource
{
    protected static ?string $model = CompanyInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationGroup = 'Контент';
    protected static ?string $navigationLabel='Информация о компании';
    protected static ?string $modelLabel = 'информацию о компании';

    protected static ?int $navigationSort = 5;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema(array(
                    Forms\Components\Grid::make()->schema(array(
                        Forms\Components\TextInput::make('company_name')
                            ->label('Назавание')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                    )),

                    Forms\Components\Repeater::make('phones')
                        ->label('Телефоны')
                        ->relationship('phones')
                        ->schema([
                            Forms\Components\TextInput::make('value')
                                /*->label('Телефон')*/
                                ->hiddenLabel()
                        ])
                        ->cloneable()
                        ->grid(4),
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('address_ru')
                                ->label('Адрес рус.')
                                ->maxLength(255),
                            Forms\Components\TextInput::make('address_ua')
                                ->label('Адрес укр.')
                                ->maxLength(255),
                        ]),

                    Forms\Components\FileUpload::make('logo')
                        ->directory('images')
                        ->preserveFilenames()
                        ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                            $name = $file->getClientOriginalName();
                            $ext = pathinfo($name, PATHINFO_EXTENSION);

                            return (string) str('logo-icon.'.$ext);
                        })
                        ->label('Логотип'),
                   /* Forms\Components\Toggle::make('active')
                        ->label('Статус')
                        ->afterStateUpdated(function ($record){
                            return self::actionWithStatus($record->id);
                        })*/
                )),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Назавание')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('active')
                    ->label('Статус')
                    ->afterStateUpdated(function ($record){
                        return self::actionWithStatus($record->id);
                    }),
                Tables\Columns\TextColumn::make('phones')
                    ->label('Телефон')
                    ->searchable()
                    ->html()
                    ->getStateUsing(function (CompanyInfo $record){
                        $phones_line = '';
                        foreach ($record->phones as $phone){
                            $phones_line .= $phone->value.'<br>';
                        }
                        return $phones_line;
                    }),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                /*Tables\Columns\TextColumn::make('address_ru')
                    ->label('Адрес')
                    ->searchable(),*/
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Логотип')
                    ->searchable(),

            ])


            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCompanyInfos::route('/'),
        ];
    }

    public static function actionWithStatus($id): void
    {
        $companiesInfo = CompanyInfo::query()->where('id', '!=', $id)->get();

        if(!$companiesInfo->isEmpty()){
            $companiesInfo->toQuery()->update([
                'active' => 0
            ]);
        }
    }
}
