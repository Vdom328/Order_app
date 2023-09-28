<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IRestaurantSettingRepository;
use App\Models\RestaurantSetting;

class RestaurantSettingRepository extends BaseRepository implements IRestaurantSettingRepository
{

    public function model()
    {
        return RestaurantSetting::class;
    }


}
