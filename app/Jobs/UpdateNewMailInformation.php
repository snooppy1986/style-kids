<?php

namespace App\Jobs;

use App\Classes\NewPost;
use App\Models\NewPostArea;
use App\Models\NewPostCity;
use App\Models\NewPostWarehouse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateNewMailInformation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $api_key;
    /**
     * Create a new job instance.
     */
    public function __construct($api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        new NewPost(model: NewPostArea::class, modelName: 'AddressGeneral', calledMethod: 'getAreas');
        new NewPost(model: NewPostCity::class, modelName: 'AddressGeneral', calledMethod: 'getCities');
        new NewPost(model: NewPostWarehouse::class, modelName: 'AddressGeneral', calledMethod: 'getWarehouses');
    }
}
