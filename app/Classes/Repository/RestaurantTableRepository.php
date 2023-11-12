<?php

namespace App\Classes\Repository;


use App\Classes\Repository\Interfaces\IRestaurantTableRepository;
use App\Models\RestaurantTable;

class RestaurantTableRepository extends BaseRepository implements IRestaurantTableRepository
{

    public function model()
    {
        return RestaurantTable::class;
    }


}
