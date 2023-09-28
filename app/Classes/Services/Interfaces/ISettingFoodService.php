<?php

namespace App\Classes\Services\Interfaces;

interface ISettingFoodService
{
    public function storeFood($data);
    public function getListFood();
    public function getListFoodAjax();
    public function delete($id);
    public function get($id);
    public function updateFood($data,$id);
}
