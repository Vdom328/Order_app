<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Services\Interfaces\IRestaurantService;
use App\Classes\Services\Interfaces\ISettingFoodService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantFoodController extends Controller
{

    protected $restaurantService, $settingFoodService;

    public function __construct(
        IRestaurantService $restaurantService,
        ISettingFoodService $settingFoodService

    ) {
        $this->restaurantService = $restaurantService;
        $this->settingFoodService = $settingFoodService;
    }

    public function index()
    {
        $restaurant = $this->restaurantService->getRestaurants();
        $foods = $this->settingFoodService->getListFood();
        return view('admin.restaurant_food.index',compact('restaurant','foods'));
    }
}
