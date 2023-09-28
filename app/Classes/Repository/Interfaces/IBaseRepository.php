<?php

namespace App\Classes\Repository\Interfaces;

interface IBaseRepository
{
    /**
     * Find data
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Add data
     * @param $attribute
     * @return mixed
     */
    public function create($attribute);

    /**
     * Update data
     * @param $id
     * @param $attribute
     * @return mixed
     */
    public function update($id, $attribute);

    /**
     * Delete data
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Get all
     * @return mixed
     */
    public function all();

    /**
     * insert data
     * @param $attribute
     * @return mixed
     */
    public function insert($attribute);

    /**
     * findOrFail data
     * @param $id
     * @return mixed
     */
    public function findOrFail($id);

    /**
     * Find all records that match a given conditions with paginate
     *
     * @param array $conditions
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate(int $pageSize, array $conditions = [], array $relation);

    /**
     * Find a specific record that matches a given conditions
     *
     * @param array $conditions
     *
     * @return Model
     */
    public function findOne(array $conditions);

    /**
     * Find a specific record by its ID
     *
     * @param int $id
     *
     * @return Model
     */
    public function findById(int $id);


    public function whereParam($column, $parameter);
}
