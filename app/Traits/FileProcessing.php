<?php
namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileProcessing
{
    public function makeDirectory($path)
    {
        //Check if the directory already exists
        if(!File::isDirectory($path)){
            dd('true');
        }
    }

    public static function downloadFileFromUrl($str, $type){
        $urls = explode(', ', $str);

        $filesData= [];
        foreach ($urls as $url){
            if(Str::isUrl($url)){
                $fileName = basename($url);
                $path = 'images/'.$type.'/'.$fileName;
                $filesData[] = [
                    'path' => $path,
                    'name' => $fileName
                ];
                /*$filesData['path'] = $path;
                $filesData['name'] = $fileName;*/

                Storage::disk('public')->put($path, file_get_contents($url));
            }
        }
        return $filesData;
    }
}
