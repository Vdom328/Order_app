<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IBaseRepository;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements IBaseRepository
{
    /**
     * @var \App\Models\BaseModel | \Illuminate\Database\Eloquent\Builder
     */
    public $model;

    public function __construct()
    {
        $this->model = $this->makeModel();
    }

    abstract public function model();

    /**
     * @return \App\Models\BaseModel | \Illuminate\Database\Eloquent\Builder
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function makeModel()
    {
        return app()->make($this->model());
    }

    // Get all data
    public function all()
    {
        return $this->model->all();
    }

    // Find data
    public function find($id)
    {
        return $this->model->find($id);
    }

    // FindOrFail data
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    // Create data
    public function create($attribute)
    {
        return $this->model->create($attribute);
    }

    // Update data
    public function update($id, $attribute)
    {
        return $this->model->where($this->model->getKeyName(), $id)->update($attribute);
    }

    // Delete data
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // Insert data
    public function insert($attribute)
    {
        return $this->model->insert($attribute);
    }

     /**
     * @inheritdoc
     */
    public function paginate(int $pageSize, array $conditions = [], array $relation = [])
    {
        return $this->model->with($relation)->where($conditions)->paginate($pageSize);
    }

    /**
     * @inheritdoc
     */
    public function findOne(array $conditions)
    {
        return $this->model->where($conditions)->first();
    }

    /**
     * @inheritdoc
     */
    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }
    
}
