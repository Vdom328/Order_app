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


    /**
     * get list food Setting quantity >=1
     */
    public function getListFoodAjax()
    {
        return SettingFood::where('quantity','>=',1)->get();
    }


}
