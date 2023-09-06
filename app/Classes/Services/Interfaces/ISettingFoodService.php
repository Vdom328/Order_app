<?php

namespace App\Classes\Services\Interfaces;

interface ISettingFoodService
{
    public function storeFood($data);
    public function getListFood();
}
