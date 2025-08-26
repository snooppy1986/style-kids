<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\ProductsRelationManager;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use App\Models\DeliveryCompany;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Контент';
    protected static ?int $navigationSort = 3;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Fieldset::make('customer')
                        ->label('Покупатель')
                        ->relationship('customer')
                        ->schema([
                            Forms\Components\FileUpload::make('photo'),
                            Forms\Components\TextInput::make('name')
                                ->label('Имя')
                                ->required()
                                ->maxLength(256),

                            Forms\Components\TextInput::make('phone')
                                ->label('Телефон')
                                ->required()
                                ->maxLength(16),

                            Forms\Components\TextInput::make('email')
                                ->label('Электронная почта')
                                ->maxLength(256)
                        ])

                ]),
                Forms\Components\Card::make()->schema(array(
                    Forms\Components\Grid::make(1)->schema(array(
                        Forms\Components\Fieldset::make('delivery')
                            ->label('Доставка')
                            ->relationship('delivery')
                            ->columns(2)
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label('Компания')
                                    ->options(DeliveryCompany::all()->pluck('name', 'name')),
                                Forms\Components\TextInput::make('area')
                                    ->label('Область'),
                                Forms\Components\TextInput::make('city')
                                    ->label('Город'),
                                Forms\Components\TextInput::make('warehouse')
                                    ->label('Отделение')
                            ])

                    ))
                )),

                Forms\Components\Card::make()->schema(array(
                    Forms\Components\ToggleButtons::make('status')
                        ->label('Статус')
                        ->inline()
                        ->options(OrderStatus::class)
                )),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->label('№')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Имя')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('customer.phone')
                    ->label('Телефон')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.email')
                    ->label('Email')
                    ->default('Не указан')
                    ->sortable()
                    ->searchable(),
                /*Tables\Columns\TextColumn::make('status')
                    ->label('Статус')
                    ->sortable()
                    ->badge(),*/
                Tables\Columns\TextColumn::make('total_price')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->sortable()
                    ->searchable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton(),
                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'new')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 0 ? 'success' : 'warning';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit')
        ];
    }

    public static function getPluralLabel():?string
    {
        return 'Заказы';
    }

    public static function getRelations(): array
    {
        return [
            ProductsRelationManager::class
        ];
    }

    public static function getWidgets(): array
    {
        return [
            OrderStats::class
        ];
    }

}
