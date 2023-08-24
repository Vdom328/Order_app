<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IIngredientRepository;
use App\Models\Ingredient;

class IngredientRepository extends BaseRepository implements IIngredientRepository
{

    public function model()
    {
        return Ingredient::class;
    }


}
