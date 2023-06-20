<?php

namespace App\Classes\Repository;

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
}
