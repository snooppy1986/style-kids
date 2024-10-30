<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Enums\PrimaryColor;
use App\Models\Product;
use App\Models\Size;
use App\Models\Sku;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'order_products';
    public int $count = 1;
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Select::make('product_id')
                            ->label('Список товаров')
                            ->helperText(function ($operation){
                                if($operation == 'create'){
                                    return new HtmlString('<span class="text-primary-500">Нужно выбрать товар.</span>');
                                }
                            })
                            ->options(Product::all()->pluck('title', 'id'))
                            ->live()
                            ->required(),
                        Select::make('sku_id')
                            ->label('Список модификаций товара')
                            ->selectablePlaceholder(true)
                            ->helperText( function ($operation){
                                if($operation == 'create'){
                                    return new HtmlString('<span class="text-primary-500">Нужно выбрать модификацию товара.</span>');
                                }
                            })
                            ->options(
                                function (Get $get){
                                    if($get('product_id')){
                                        return Product::query()
                                            ->with('skus' )
                                            ->where('id', $get('product_id'))
                                            ->first()
                                            ->skus
                                            ->pluck('code', 'code')
                                            ->toArray();
                                    }

                                }
                            )
                            ->required()
                            ->live()
                            ->afterStateUpdated(
                                function(Set $set, $state){
                                    $sku = Sku::query()
                                        ->where('code', $state)
                                        ->first();
                                    /*dd($sku->sizes->pluck('size', 'id'));*/
                                    $set('color', $sku->color);
                                    $set('unit_price', $sku->discount_price ?? $sku->price);

                                }
                             ),

                        Forms\Components\ColorPicker::make('color')
                            ->label('Цвет'),

                        Forms\Components\TextInput::make('unit_price')
                            ->label('Цена')
                            ->numeric(1)
                            ->minValue(1)
                            ->step(1),
                        Forms\Components\TextInput::make('qty')
                            ->label('К-во')
                            ->numeric(1)
                            ->minValue(1)
                            ->default(1)
                            ->step(1),
                        Forms\Components\Select::make('size')
                            ->label('Размер')
                            ->selectablePlaceholder(true)
                            ->options(
                                function(Get $get){
                                    if($get('sku_id')){
                                        $sku = Sku::query()
                                            ->with('sizes')
                                            ->where('code', $get('sku_id'))
                                            ->first();

                                        if($sku && $sku->sizes){
                                            return $sku->sizes->pluck('size', 'id');
                                        }
                                    }
                                }
                            )
                            ->helperText( function ($operation){
                                if($operation == 'create'){
                                    return new HtmlString('<span class="text-primary-500">Нужно выбрать размер товара.</span>');
                                }
                            })
                            ->required()

                    ])

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('product.title')
                    ->label('Название'),
                Tables\Columns\ColorColumn::make('color')
                    ->label('Цвет'),
                Tables\Columns\TextColumn::make('sizes.size')
                    ->label('Размер'),
                Tables\Columns\TextColumn::make('qty')
                    ->label('К-во'),
                Tables\Columns\TextColumn::make('unit_price')
                    ->label('Цена'),
            ])

            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Добавить'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading('Будет удален товар из заказа.')
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
