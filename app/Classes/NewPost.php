<?php

namespace App\Classes;

use App\Models\DeliveryCompany;
use App\Models\NewPostArea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class NewPost
{
    protected $request = [];

    private $url = 'https://api.novaposhta.ua/v2.0/json/';

    public function __construct($modelName, $calledMethod, $model, $ref=null)
    {

        /*dd($modelName, $calledMethod, $model);*/
        $model::truncate();
        $this->url = 'https://api.novaposhta.ua/v2.0/json/';
        $this->request['apiKey'] = DeliveryCompany::query()
            ->where('id', 1)
            ->first()
            ->api_key;
        $this->request['modelName'] = $modelName;
        $this->request['calledMethod'] = $calledMethod;
        $this->request['methodProperties'] = ['CityRef'=>$ref];
        $this->location($model);
    }
    public function location($model)
    {
        $response_json = Http::asJson()
            ->post($this->url, $this->request);

        foreach (json_decode($response_json)->data as $item){
            /*dd(json_decode(json_encode($item), true));*/
            $model::create(json_decode(json_encode($item), true));
        }
    }
}
