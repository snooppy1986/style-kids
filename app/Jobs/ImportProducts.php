<?php

namespace App\Jobs;

use App\Events\JobImportProductsCompleted;
use App\Imports\ProductsImport;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ImportProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $file;
    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct($file, $user)
    {
        $this->file = $file;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \Maatwebsite\Excel\Facades\Excel::import(new ProductsImport, $this->file);

        event(new JobImportProductsCompleted($this->user));
    }
}
