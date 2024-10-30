<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $label='';
    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationGroup = 'Контент';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //Main section
                Forms\Components\Section::make()
                    ->schema([
                        //Title and slug grid
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title_ru')
                                    ->label('Название')
                                    ->required()
                                    ->maxLength(2048)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set $set, ?string $state){
                                        $set('slug', time().'-'.Str::slug($state));
                                    })
                                    ->afterStateUpdated(function (Get $get, Set $set, $state){
                                        $url = env('APP_URL').'/category/show/'.$get('slug');
                                        $set('canonical_url', $url);
                                    }),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->readOnly()
                                    ->maxLength(2048),
                            ]),
                        //Image and parent category grid
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\FileUpload::make('thumbnail')
                                    ->directory('images/categories')
                                    ->label('Изображение')
                                    ->image()
                                    ->imageResizeMode('cover')
                                    ->imageResizeTargetWidth('261')
                                    ->imageResizeTargetHeight('257'),
                                Forms\Components\Select::make('parent_id')
                                    ->label('Родительская категория')
                                    ->options(Category::all()->pluck('title_ru', 'id'))
                            ]),
                        //Status
                        Forms\Components\Toggle::make('status')
                            ->label('Статус')
                            ->onColor('success')
                            ->offColor('danger')
                    ]),

                //Seo section
                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('canonical_url')
                            ->label('Адрес')
                            ->readOnly(),
                        Forms\Components\TextInput::make('seo_title')
                            ->label('Название страницы'),
                        Forms\Components\TextInput::make('keywords')
                            ->label('Ключевые слова'),
                        Forms\Components\TextInput::make('description')
                            ->label("Описание страницы"),
                    ])

            ]);
    }

    /**
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Изображение'),
                Tables\Columns\TextColumn::make('title_ru')
                    ->label('Название')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Статус')
                    ->onColor('success')
                    ->offColor('danger')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->sortable()
                    ->dateTime('d-m-Y H:i:s'),
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
        return static::getModel()::count() > 0 ? 'danger' : 'warning';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
        ];
    }

    public static function getPluralLabel():?string
    {
        return 'Категории';
    }
}
