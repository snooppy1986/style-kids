<?php

namespace App\Repositories\Size;

use App\Models\Size;
use App\Repositories\BaseRepository;

class SizeRepository extends BaseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Size $size)
    {
        parent::__construct($this->size);
    }

    public function getAllSizes()
    {
        return $this->model->all();
    }
}
