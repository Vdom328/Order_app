<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IRestaurantMealRepository;
use App\Models\RestaurantMeal;

class RestaurantMealRepository extends BaseRepository implements IRestaurantMealRepository
{

    public function model()
    {
        return RestaurantMeal::class;
    }

    public function deleteByRestaurantId($restaurant_id)
    {
        return $this->model->where("restaurant_id", $restaurant_id)->delete();
    }
}
