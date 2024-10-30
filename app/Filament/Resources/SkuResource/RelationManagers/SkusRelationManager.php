<?php

namespace App\Filament\Resources\SkuResource\RelationManagers;

use App\Forms\Components\ColorSelect;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Filament\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;

use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class SkusRelationManager extends RelationManager
{
    protected static string $relationship = 'skus';
    /*protected static ?string $label='';*/
    protected static ?string $title = 'Опции товара';
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    //Repeater product attributes
                    Repeater::make('attributeOptions')
                        ->relationship('attributeOptions')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    //Attributes list
                                    Select::make('attribute_id')
                                        ->relationship('attribute', 'name')
                                        ->afterStateUpdated(function (Set $set, $state){

                                        })
                                        ->live(),

                                    //Option value size
                                    /*Forms\Components\TextInput::make('value')
                                        ->datalist(
                                            AttributeOption::query()->pluck('value')
                                        ),*/
                                    Select::make('value')
                                        ->options(
                                            function(Get $get, $state){
                                                $attributes = AttributeOption::query()
                                                    ->where('attribute_id', $get('attribute_id'))
                                                    ->pluck('value', 'id')
                                                    ->toArray();

                                                return $attributes;
                                            }
                                        )
                                       ->visible(fn (Get $get): bool => $get('attribute_id')==1),
                                    //Option value color
                                    Forms\Components\ColorPicker::make('value')
                                        ->visible(fn (Get $get): bool => $get('attribute_id')==2)
                                ]),

                        ])->columnSpanFull(),


                    //Repeater product attributes
                    /*Repeater::make('attributeOptions')
                        ->relationship('attributeOptions')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    //Attributes list
                                    Select::make('attribute_id')
                                        ->relationship('attribute', 'name')
                                        ->afterStateUpdated(function (Set $set, $state){

                                        })
                                        ->live(),

                                    //Option value size
                                    Select::make('value')
                                        ->options(
                                            function(Get $get, $state){
                                                $attributes = AttributeOption::query()
                                                    ->where('attribute_id', $get('attribute_id'))
                                                    ->pluck('value', 'value')
                                                    ->toArray();

                                                return $attributes;
                                            }
                                        )
                                        ->unique(AttributeOption::class, 'value')
                                        ->visible(fn (Get $get): bool => $get('attribute_id')==1),
                                    //Option value color
                                    Forms\Components\ColorPicker::make('value')
                                        ->visible(fn (Get $get): bool => $get('attribute_id')==2)
                                ]),

                        ])->columnSpanFull(),*/

                    //Sku product information
                    Forms\Components\Grid::make(3)->schema(array(
                        Forms\Components\TextInput::make('code')
                            ->label('Код'),
                        Forms\Components\TextInput::make('price')
                            ->numeric(2)
                            ->step(1)
                            ->required(),

                        Forms\Components\TextInput::make('discount_price')
                            ->numeric()
                            ->step(1),
                    )),

                    Forms\Components\Grid::make(3)->schema(array(
                        Forms\Components\Toggle::make('new')
                            ->label('Новинка'),
                        Forms\Components\Toggle::make('hit')
                            ->label('Хит'),
                    )),
                ])->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {

        return $table
            ->recordTitleAttribute('product_id')
            ->columns([
                Tables\Columns\TextColumn::make('code')->label('Код'),
                Tables\Columns\TextColumn::make('price')->label('Цена'),
                Tables\Columns\TextColumn::make('discount_price')->label('Цена со скидкой'),
                Tables\Columns\IconColumn::make('new')->boolean()->label('Новинка'),
                Tables\Columns\IconColumn::make('hit')->boolean()->label('Хит'),
               /* Tables\Columns\TextColumn::make('attributes.name')
                    ->label('Атрибут')
                    ->badge()
                    ->wrap(),*/

                Tables\Columns\TextColumn::make('attributeOptions.value')
                    ->label('Атрибуты')
                    ->formatStateUsing(function ($state){
                        if( preg_match('/^#([a-f0-9]{6}|[a-f0-9]{3})$/i', $state) ){
                            return "Цвет <div style='background-color: $state;
                                        border-radius: 50%;
                                        width: 25px;
                                        color: white;
                                        line-height: 2;
                                        font-size: 10px;
                                        height: 25px'></div>";
                        }
                        return '<p style="line-height: 2; position: relative; top: -6px">Размер</p>'.$state;

                    })
                    ->badge()
                    ->wrapHeader()
                    ->html()

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPluralLabel():?string
    {
        return 'Опции товара';
    }
}
