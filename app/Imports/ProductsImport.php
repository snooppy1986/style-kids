<?php

namespace App\Imports;

use App\Models\Category;
use App\Enums\PrimaryColor;
use App\Models\Product;
use App\Models\Sku;
use App\Notifications\SuccessNotification;
use App\Traits\FileProcessing;
use App\Traits\ProductImportGetSpecialValues;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Events\AfterImport;

class ProductsImport implements ToCollection, WithStartRow, WithMultipleSheets, WithChunkReading, WithBatchInserts, ShouldQueue, WithEvents
{
    use FileProcessing;
    use ProductImportGetSpecialValues;

    protected $user;
    protected $newProductsCount;
    protected $updatedProductsCount;
    protected $startTime;

    public function __construct()
    {
        $this->user = \Auth::user();
        $this->startTime = date(format: 'Y-m-d H:i:s');
    }

    public function collection(Collection $rows)
    {
        ini_set('max_execution_time', 0);
        $categories = Category::all('id', 'group_number');
        /*dd((PrimaryColor::cases()));*/

        foreach ($rows as $row){
            if(!$product = Product::query()->where('code', '=', $row[0])->first()){
                $characteristics = array_chunk($row->splice(49)->toArray(), 3, false);
                $slug_ru = self::getSlug($row[1]);
                $slug_ua = self::getSlug($row[2]);
                $thumbnails = self::getThumbnail($row[14]);
                $canonical_url_ru = self::getCanonicalUrl($slug_ru);
                $canonical_url_ua = self::getCanonicalUrl($slug_ua);
                $color = '';
                $type = '';
                $skus_length = Sku::all()->count();
                /*dd($row[0]);*/

                $product = Product::updateOrCreate(
                    [
                        'code' => $row[0]  ? $row[0] : 0
                    ],
                    [
                        'code'=>$row[0],
                        'title_ru'=>$row[1] ? $row[1] : '',
                        'title_ua'=>$row[2] ? $row[2] : '',
                        'slug_ru'=>$slug_ru,
                        'slug_ua'=>$slug_ua,
                        'thumbnail'=>$thumbnails[0]['path'] ?? '',
                        'body_ru'=>$row[5] ?? '',
                        'body_ua'=>$row[6] ?? '',
                        'active'=>$row[15]=='+' ? 1 : 0,
                        'canonical_url_ru' => $canonical_url_ru,
                        'canonical_url_ua' => $canonical_url_ua,
                        'seo_title_ru' => $row[1].' | '.env('APP_NAME'),
                        'seo_title_ua' => $row[2].' | '.env('APP_NAME'),
                        'keywords_ru' => $row[3],
                        'keywords_ua' => $row[4],
                    ]
                );
                $product->save();

                /*category product*/
                if($categories->where('group_number', $row[17])->first()){
                    $product->categories()->attach($categories->where('group_number', $row[17])->first()->id);
                }

                /*gallery images*/
                foreach ($thumbnails as $thumbnail){
                    $product->productGallery()->updateOrCreate(
                        [
                            'product_id'=>$product->id,
                            'image_path' =>$thumbnail['path'],
                        ],
                        [
                            'image'=> str_replace('"', '', $thumbnail['name']),
                            'created_at'=>now(),
                            'updated_at'=>now()
                        ]
                    );
                }

                /*product characteristics*/
                foreach ($characteristics as $characteristic){
                    if($characteristic[0]){
                        if($characteristic[0]=='Цвет'){
                            foreach (PrimaryColor::cases() as $case){
                                if($characteristic[2] == $case->value){
                                    $color = 'rgb('.$case->getColor()[600].')';
                                }
                            }
                        }
                        if(trim($characteristic[0])=='Вид обуви'){
                            $product->update([
                                'type' => 'shoes'
                            ]);
                        }

                        $product->productCharacteristics()->updateOrCreate(
                            [
                                'product_id' => $product->id,
                                'title_ru' => $characteristic[0],
                                'value_ru' => $value = $characteristic[2]
                            ],
                            [
                                'unit' => $characteristic[1]
                            ]
                        );
                    }
                }

                /*sku product*/
                $sku = $product->skus()->updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'price' => $row[8]
                    ],
                    [
                        'discount_price' => 0,
                        'code' => time().'_'.$skus_length,
                        'color' => $color
                    ]
                );

                /*product sizes*/
                if(Str::contains($row[5], 'Размер:')){
                    $array_sizes_ids = $this->getSizes($row[5]);
                    foreach ($array_sizes_ids as $size_id){

                        $sku->sizes()->updateOrCreate(
                            [
                                'sku_id' => $sku->id,
                                'size_id' => $size_id
                            ],
                            [
                                'count' => $row[16]
                            ]
                        );
                    }
                }

            }else{
                /*update slug_ua*/
                if(!empty($row[2]) && empty($product->slug_ua)){
                    $product->update([
                        'slug_ua' => self::getSlug($row[2])
                    ]);
                }
                /*update title_ua*/
                if(!empty($row[2]) && empty($product->title_ua)){
                    $product->update([
                        'title_ua' => $row[2]
                    ]);
                }

                /*update body_ru*/
               /* dd(empty($product->body_ru));*/
                if(!empty($row[5]) && empty($product->body_ru)){
                    /*dd('body_ru');*/
                    $product->update([
                        'body_ru' => $row[5]
                    ]);
                }

                /*update body_ua*/
                if(!empty($row[6]) && empty($product->body_ua)){
                    $product->update([
                        'body_ua' => $row[6]
                    ]);
                }

            }
        }

    }

    public static function getSlug($str)
    {
        return Str::slug($str);
    }

    public static function getThumbnail($thumbnail_link)
    {
        return self::downloadFileFromUrl($thumbnail_link, 'products');
    }

    public static function getCanonicalUrl($slug){
        return url('products/'.$slug);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    public function batchSize(): int
    {
        return 100;
    }
    public function chunkSize(): int
    {
        return 100;
    }

    public function registerEvents(): array
    {
        return  [
            AfterImport::class => function(AfterImport $event){
                $start_time = $event->getConcernable()->startTime;
                $new_count = Product::query()
                    ->where('created_at', '>', $start_time)
                    ->count();

                $this->user->notify(
                    new SuccessNotification(
                        title: 'Импорт товаров завершен.',
                        icon: 'heroicon-o-document-arrow-down',
                        body: 'Импортировано новых товаров '.$new_count,
                        redirectTo: 'admin/products'
                    )
                );
                return redirect()->back();
            }
        ];
    }
}
