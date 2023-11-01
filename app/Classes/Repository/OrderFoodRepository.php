<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IOrderFoodRepository;
use App\Models\OrderFood;

class OrderFoodRepository  extends BaseRepository implements IOrderFoodRepository
{

    public function model()
    {
        return OrderFood::class;
    }



}
