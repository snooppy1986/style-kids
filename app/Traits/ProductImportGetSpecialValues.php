<?php
namespace App\Traits;

use App\Models\Size;
use Illuminate\Support\Str;
use function League\Uri\Idna\cases;

trait ProductImportGetSpecialValues
{
    public function getSizes(string $row): array
    {
        $subStr = Str::after($row, 'Размер:');
        $str = Str::before($subStr, '<br />');
        preg_match_all('!\d+!', $str, $array_sizes);
        $sizesIds = self::createSizes($array_sizes[0]);
        /*dd($array_sizes);*/
        return $sizesIds;
    }

    protected function createSizes(array $sizes): array
    {
        $ids = [];
        foreach ($sizes as $size){
            $size = Size::query()->updateOrCreate(
                ['value' => $size],
                [
                    'value' => $size
                ]
            );
            $ids[] = $size->id;
        }

        return $ids;
    }

}
