<?php

namespace App\Classes\Repository\Interfaces;


interface IRestaurantMealRepository extends IBaseRepository
{
    public function deleteByRestaurantId($restaurant_id);
}
