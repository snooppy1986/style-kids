<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Enums\PrimaryColor;
use App\Models\Product;
use App\Models\Size;
use App\Models\Sku;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Termwind\Enums\Color;
use function Filament\Navigation\label;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationLabel='Товары';
    protected static ?string $modelLabel = 'Товара';
    protected static ?string $pluralModelLabel = 'Товары';
    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $navigationGroup = 'Контент';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Wizard::make([
                            Forms\Components\Wizard\Step::make('Главная информация')
                                ->schema([
                                    Section::make()
                                        ->schema(static::getMainInfoFormSchema()),

                                    //Repeater product attributes
                                    Section::make('Опции')
                                        ->headerActions([
                                                \Filament\Forms\Components\Actions\Action::make('reset')
                                                    ->label('Удалить все опции')
                                                    ->modalHeading('Вы уверены что хотите удалить все опции товара?')
                                                    ->modalDescription('Все опции товара будут удалены.')
                                                    ->requiresConfirmation()
                                                    ->color('danger')
                                                    ->action(fn (Forms\Set $set) => $set('skus', [])),
                                            ]
                                        )
                                        ->schema(static::getRepeaterItemFormSchema()),

                                    //SEO
                                    Section::make('SEO')
                                        ->schema(
                                            static::getSeoInfoFormSchema()
                                        )

                                ]),

                            Forms\Components\Wizard\Step::make('Галерея картинок')
                                ->schema([
                                    Forms\Components\FileUpload::make('thumbnail')
                                        ->disk('public')
                                        ->directory('images/products')
                                        ->label('Главное изображение')
                                        ->image()
                                        ->imageResizeMode('cover')
                                        ->imageResizeTargetWidth('431')
                                        ->imageResizeTargetHeight('323'),

                                    Forms\Components\Repeater::make('productGallery')
                                        ->label('Галерея')
                                        ->relationship()
                                        ->default(['visible'=>true])
                                        ->schema([
                                            Forms\Components\FileUpload::make('image')
                                                ->label('Картинка')
                                                ->deletable(false)
                                                ->directory('images/products')
                                                ->image()
                                                ->imageResizeMode('cover')
                                                ->imageResizeTargetWidth('431')
                                                ->imageResizeTargetHeight('323'),
                                        ])
                                        ->addable(true)
                                        ->reorderable(true)
                                        ->deletable(true)
                                        ->defaultItems(1)
                                        ->addActionLabel('Добавить картинку в галерею')
                                        ->columnSpan('full')
                                ]),

                            /*Forms\Components\Wizard\Step::make('Опции товара')
                                ->schema([
                                    //Repeater product attributes
                                    Repeater::make('skus')
                                        ->label('Опции товара')
                                        ->relationship()
                                        ->schema([
                                            Forms\Components\Grid::make(2)
                                                ->schema([
                                                    Repeater::make('Sizes')
                                                        ->label('Размеры')
                                                        ->relationship('sizes')
                                                        ->schema([
                                                            Forms\Components\Grid::make(2)->schema([
                                                                Select::make('size')
                                                                    ->label('Размер')
                                                                    ->options(Size::all()->pluck('size', 'size')),
                                                                TextInput::make('count')
                                                            ])
                                                        ])
                                                        ->addActionLabel('Добавить размер')
                                                        ->columnSpanFull(),
                                                    ]),

                                            //Sku product information
                                            Forms\Components\Grid::make(2)->schema([
                                                Forms\Components\TextInput::make('code')
                                                    ->label('Код')
                                                    ->default(
                                                        function (){
                                                            $skus_length = Sku::all()->count();
                                                            return time().'_'.$skus_length;
                                                        }
                                                    )
                                                    ->readOnly(),

                                                Select::make('color')
                                                    ->label('Цвет')
                                                    ->native(false)
                                                    ->allowHtml()
                                                    ->selectablePlaceholder(false)
                                                    ->options(
                                                        collect(PrimaryColor::cases())
                                                            ->mapWithKeys(static fn ($case) =>[
                                                                $case->value => "<span class='flex items-center gap-x-4'>
                                                                    <span class='rounded-full w-4 h-4' style='background:rgb(" . $case->getColor()[600] . ")'></span>
                                                                    <span>" . $case->getLabel() . '</span>
                                                                    </span>',
                                                            ]),
                                                    ),
                                            ]),
                                            Forms\Components\Grid::make(2)->schema(array(

                                                Forms\Components\TextInput::make('price')
                                                    ->label('Цена')
                                                    ->numeric(2)
                                                    ->step(1)
                                                    ->required(),
                                                Forms\Components\TextInput::make('discount_price')
                                                    ->label('Цена со скидкой')
                                                    ->numeric()
                                                    ->step(1),

                                            )),
                                            Forms\Components\Grid::make(3)->schema(array(
                                                Forms\Components\Toggle::make('new')
                                                    ->label('Новинка'),
                                                Forms\Components\Toggle::make('hit')
                                                    ->label('Хит'),
                                            )),

                                        ])
                                        ->addActionLabel('Добавить опцию')
                                        ->columnSpanFull(),
                                ]),*/

                            /*Forms\Components\Wizard\Step::make('SEO')
                                ->schema([
                                    TextInput::make('canonical_url')
                                        ->default(function ($state){
                                            if($state){
                                                return 'text';
                                            }
                                        })
                                        ->readOnly(),
                                    TextInput::make('seo_title'),
                                    TextInput::make('keywords'),
                                    TextInput::make('description')
                                ])*/
                        ])
                    ])->columnSpan(12)
            ])->columns(12) ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Картинка')
                    ->disk('public')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title_ru')
                    ->label('Название')
                    ->searchable(),

                Tables\Columns\IconColumn::make('active')
                    ->label('Статус')
                    ->sortable()
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime('d-m-Y H:i:s')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([

            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label('')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /*protected function handleRecordUpdate(Product $record, array $data): Product
    {
        $record->fill($data);

        $keysToWatch = [
            'color'
        ];

        if($record->isDirty($keysToWatch)){
            $this->dispatch('productUpdate');
        }

        $record->save();

        return $record;
    }*/


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 0 ? 'warning' : 'warning';
    }

    public static function getRelations(): array
    {
        return [
            /*SkusRelationManager::class*/
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getMainInfoFormSchema(): array
    {
        return [
            //Name and slug ru
            Forms\Components\Grid::make(2)->schema(array(
                Forms\Components\TextInput::make('title_ru')
                    ->label('Название (рус.)')
                    ->required()
                    ->maxLength(2048)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $operation, ?string $old, $state, ?Model $record) {
                        $set('slug_ru', time().'_'.Str::slug($state));
                    })
                    ->afterStateUpdated(function (Get $get, Set $set, $state){
                        $url = env('APP_URL').'/product/show/'.$get('slug_ru');
                        $set('canonical_url_ru', $url);
                    }),

                TextInput::make('slug_ru')
                    ->label('Slug (рус.)')
                    ->maxLength(255)
                    ->unique(Product::class, 'slug_ru', fn ($record) => $record)
                    ->readOnly()
                /*->disabled(fn (?string $operation, ?Model $record) => $operation == 'edit' && $record->active)*/
            )),
            //Name and slug ua
            Forms\Components\Grid::make(2)->schema(array(
                Forms\Components\TextInput::make('title_ua')
                    ->label('Название (укр.)')
                    ->required()
                    ->maxLength(2048)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $operation, ?string $old, $state, ?Model $record) {
                        $set('slug_ua', time().'_'.Str::slug($state));
                    })
                    ->afterStateUpdated(function (Get $get, Set $set, $state){
                        $url = env('APP_URL').'/product/show/'.$get('slug_ua');
                        $set('canonical_url_ua', $url);
                    }),

                TextInput::make('slug_ua')
                    ->label('Slug (укр.)')
                    ->maxLength(255)
                    ->unique(Product::class, 'slug_ua', fn ($record) => $record)
                    ->readOnly()
                /*->disabled(fn (?string $operation, ?Model $record) => $operation == 'edit' && $record->active)*/
            )),
            //Category and status
            Forms\Components\Grid::make(1)
                ->schema([
                    Forms\Components\Select::make('categories')
                        ->label('Категория')
                        ->default(null)
                        ->multiple()
                        ->relationship('categories', 'title_ru')
                        ->preload()
                        ->searchable(),
                ]),
            Forms\Components\RichEditor::make('body_ru')
                ->label('Описание товара (рус.)')
                ->required()
                ->columnSpanFull(),
            Forms\Components\RichEditor::make('body_ua')
                ->label('Описание товара (укр.)')
                ->required()
                ->columnSpanFull(),

            //Status
            Forms\Components\Toggle::make('active')
                ->label('Статус')
                ->onColor('success')
                ->offColor('danger')
                ->required(),
        ];
    }

    public static function getSeoInfoFormSchema(): array
    {
        return [
            TextInput::make('canonical_url_ru')
                ->disabled()
                ->default(function ($state){
                    if($state){
                        return 'text';
                    }
                })
                ->readOnly(),
            TextInput::make('canonical_url_ua')
                ->disabled()
                ->default(function ($state){
                    if($state){
                        return 'text';
                    }
                })
                ->readOnly(),
            TextInput::make('seo_title_ru'),
            TextInput::make('seo_title_ua'),
            TextInput::make('keywords_ru'),
            TextInput::make('keywords_ua'),
            TextInput::make('description_ru'),
            TextInput::make('description_ua')
        ];
    }

    public static function getRepeaterItemFormSchema(): array
    {
        return [
            Repeater::make('skus')
                ->label('Опции товара')
                ->relationship()
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Repeater::make('sizes')
                                ->label('Размеры')
                                ->relationship()
                                ->schema([
                                    Forms\Components\Grid::make(2)->schema([
                                        Select::make('size_id')
                                            ->label('Размер')
                                            ->options(Size::all()->pluck('value', 'id'))
                                            ->createOptionForm([
                                                Forms\Components\Grid::make(1)->schema([
                                                    TextInput::make('value')
                                                        ->label('Значение')
                                                        ->integer(),

                                                ]),

                                            ])
                                            ->createOptionAction(fn($action) => $action->modalWidth('sm'))
                                            ->createOptionUsing(function (array $data){
                                                $size = Size::create([
                                                   'value'=>$data['value']
                                                ]);
                                                return $size;
                                            }),

                                        TextInput::make('count')
                                    ])
                                ])
                                ->addActionLabel('Добавить размер')
                                ->columnSpanFull(),
                        ]),

                    //Sku product information
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('Код')
                            ->default(
                                function (){
                                    $skus_length = Sku::all()->count();
                                    return time().'_'.$skus_length;
                                }
                            )
                            ->readOnly(),
                        Forms\Components\ColorPicker::make('color')
                            ->rgb()
                            ->label('Цвет')

                    ]),
                    Forms\Components\Grid::make(2)->schema(array(

                        Forms\Components\TextInput::make('price')
                            ->label('Цена')
                            ->numeric(2)
                            ->step(1)
                            ->required(),
                        Forms\Components\TextInput::make('discount_price')
                            ->label('Цена со скидкой')
                            ->numeric()
                            ->step(1),

                    )),
                    Forms\Components\Grid::make(3)->schema(array(
                        Forms\Components\Toggle::make('new')
                            ->label('Новинка'),
                        Forms\Components\Toggle::make('hit')
                            ->label('Хит'),
                    )),

                ])
                ->addActionLabel('Добавить опцию')
                ->columnSpanFull(),
        ];
    }

   /*public function save(): void
   {
       try {
           $data = $this->form->getState();

           $this->handleRecordUpdate($this->record, $data);
       }catch (Halt $exception){
           return;
       }
   }*/

}
