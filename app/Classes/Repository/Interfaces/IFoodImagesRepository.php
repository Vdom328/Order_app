<?php

namespace App\Classes\Repository\Interfaces;


interface IFoodImagesRepository extends IBaseRepository
{
    public function deleteByFoodId($food_id);
}
