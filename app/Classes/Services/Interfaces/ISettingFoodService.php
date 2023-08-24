<?php

namespace App\Classes\Services\Interfaces;

interface ISettingFoodService
{
    // Ingredient
    public function getCreateIngredient(Array $data);
    public function deleteIngredientById(int $id);
    public function getIngredient();
}
