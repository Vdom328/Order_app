<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IRestaurantFoodRepository;
use App\Models\RestaurantFood;

class RestaurantFoodRepository extends BaseRepository implements IRestaurantFoodRepository
{

    public function model()
    {
        return RestaurantFood::class;
    }

    /**
     * @inheritDoc
     */
    public function deleteByRestaurantMealId($id)
    {
        return $this->model->where("restaurant_meal_id", $id)->delete();
    }
}
