<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IFoodImagesRepository;
use App\Models\FoodImages;

class FoodImagesRepository  extends BaseRepository implements IFoodImagesRepository
{

    public function model()
    {
        return FoodImages::class;
    }


}
