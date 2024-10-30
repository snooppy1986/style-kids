<?php

namespace App\Imports;

use App\Models\Category;
use App\Notifications\SuccessNotification;
use App\Traits\FileProcessing;
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
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;

class CategoriesImport implements ToCollection, WithStartRow, WithMultipleSheets, WithChunkReading, WithBatchInserts, ShouldQueue, WithEvents
{
    use FileProcessing;

    protected $user;
    protected $startTime;

    public function __construct()
    {
        $this->user = \Auth::user();
        $this->startTime = date(format: 'Y-m-d H:i:s');
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $parent_id = self::getParent($row[4]);
            $slug = Str::slug($row[1]);
            $thumbnail = self::getThumbnail($row[14]);
            /*dd($row, $thumbnail);*/

            Category::updateOrCreate(
                [
                    'group_number' => $row[0]
                ],
                [
                    'group_number' => $row[0],
                    'title_ru' => $row[1],
                    'title_ua' => $row[2],
                    'parent_id' => $parent_id ? $parent_id->id : null,
                    'slug' => $slug,
                    'status' => 1,
                    'thumbnail' => $thumbnail[0]['path']
                ]
            );

        }
    }

    public static function getParent($group_number)
    {
        return Category::query()->where('group_number', $group_number)->first();
    }

    public static function getThumbnail($thumbnail_link)
    {
        return self::downloadFileFromUrl($thumbnail_link, 'categories');
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {

    }


    public function sheets(): array
    {
        return [
            1 => $this
        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function registerEvents(): array
    {
        return [
            AfterImport::class => function(AfterImport $event){
                $start_time = $event->getConcernable()->startTime;
                $new_count = Category::query()
                    ->where('created_at', '>', $start_time)
                    ->count();

                $this->user->notify(
                    new SuccessNotification(
                        title: 'Импорт категорий завершен.',
                        icon: 'heroicon-o-document-arrow-down',
                        body: 'Импортировано новых категорий '.$new_count,
                        redirectTo: 'admin/categories'
                        /*model: new Category()*/
                    )
                );
            }
        ];
    }
}
