<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Product;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected static ?string $navigationGroup = 'Контент';
    protected static ?int $navigationSort = 4;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->directory('images/slider')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imageResizeTargetWidth('600')
                    ->imageResizeTargetHeight('600')
                    ->required(),
                Forms\Components\Select::make('product_slug')
                    ->label('Товары')
                    ->options(Product::all()->pluck('title_ru', 'slug_ru')),
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\RichEditor::make('body_ru')
                            ->label('Описание рус.')
                            ->required()
                            ->maxLength(65535),
                        Forms\Components\RichEditor::make('body_ua')
                            ->label('Описание укр.')
                            ->required()
                            ->maxLength(65535),
                    ]),

                Forms\Components\Toggle::make('active')
                    ->label('Статус')
                    ->onColor('success')
                    ->offColor('danger')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('product_slug')
                    ->label('Товар')
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->label('Статус')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 0 ? 'warning' : 'warning';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSliders::route('/'),
        ];
    }
}
