<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BaseContract;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseContract
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Model $model)
    {
        //
    }

    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }
    
    public function findAll(): \Illuminate\Support\Collection
    {
        return $this->model->get();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $record = $this->model->findOrFail($id);
        return $record->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id);
    }
}
