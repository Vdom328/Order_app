<?php

namespace App\Classes\Repository\Interfaces;


interface IRestaurantFoodRepository extends IBaseRepository
{
    /**
     * deleteFood by deleteByRestaurantMealId
     */
    public function deleteByRestaurantMealId($id);
}
