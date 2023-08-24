<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Services\Interfaces\ISettingFoodService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FoodController extends Controller
{

    protected $settingFoodService;

    public function __construct(
        ISettingFoodService $settingFoodService,

    ) {
        $this->settingFoodService = $settingFoodService;
    }
    public function index()
    {
        return view('admin.setting_food.index');
    }
    public function getCreate()
    {
        return view('admin.setting_food.create');
    }

    public function getIngredient()
    {
        $ingredient = $this->settingFoodService->getIngredient();
        return view();
    }
}
