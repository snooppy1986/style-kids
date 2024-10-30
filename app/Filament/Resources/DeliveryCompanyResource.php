<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeliveryCompanyResource\Pages;
use App\Filament\Resources\DeliveryCompanyResource\RelationManagers;
use App\Models\DeliveryCompany;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeliveryCompanyResource extends Resource
{
    protected static ?string $model = DeliveryCompany::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Доставка';
    protected static ?int $navigationSort = 6;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название')
                    ->required()
                    ->maxLength(256),
                Forms\Components\TextInput::make('api_key')
                    ->label('Ключь API')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->directory('images/delivery_company')
                    ->label('Логотип')
                    ->image(),
                Forms\Components\Toggle::make('status')
                    ->label('Статус')
                    ->onColor('success')
                    ->offColor('danger')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Логотип'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('api_key')
                    ->label('Ключь API')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Статус')
                    ->boolean(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeliveryCompanies::route('/'),
            'create' => Pages\CreateDeliveryCompany::route('/create'),
            'edit' => Pages\EditDeliveryCompany::route('/{record}/edit'),
        ];
    }

    public static function getPluralLabel():?string
    {
        return 'Список компаний';
    }
}
