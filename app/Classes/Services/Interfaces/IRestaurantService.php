<?php

namespace App\Classes\Services\Interfaces;

interface IRestaurantService
{
    public function postUpdate($data);

    /**
     * get all restaurant
     */
    public function getRestaurants();

    /**
     * find restaurant by id
     * @param int  $id
     */
    public function findRestaurantById($id);


    /**
     * delete restaurant by id
     * @param int $id
     */
    public function delete($id);
}
