<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ISettingFoodRepository;
use App\Models\SettingFood;

class SettingFoodRepository extends BaseRepository implements ISettingFoodRepository
{

    public function model()
    {
        return SettingFood::class;
    }


}
