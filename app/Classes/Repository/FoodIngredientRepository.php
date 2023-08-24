<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IFoodIngredientRepository;
use App\Models\FoodIngredient;

class FoodIngredientRepository extends BaseRepository implements IFoodIngredientRepository
{

    public function model()
    {
        return FoodIngredient::class;
    }


}
