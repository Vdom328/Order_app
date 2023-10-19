<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Enum\TypeMealEnum;
use App\Classes\Services\Interfaces\IRestaurantService;
use App\Classes\Services\Interfaces\ISettingFoodService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantFoodController extends Controller
{

    protected $restaurantService, $settingFoodService;

    public function __construct(
        IRestaurantService $restaurantService,
        ISettingFoodService $settingFoodService,


    ) {
        $this->restaurantService = $restaurantService;
        $this->settingFoodService = $settingFoodService;
    }

    public function index()
    {
        $typeMeals = $this->getStatus();
        $restaurant = $this->restaurantService->getRestaurants();
        $foods = $this->settingFoodService->getListFood();
        return view('admin.restaurant_food.index',compact('restaurant','foods','typeMeals'));
    }

    /**
     * Get status default in project
     */
    public function getStatus(): array
    {
        $statusValues = [];
        $statusCases = TypeMealEnum::cases();
        foreach ($statusCases as $status) {
            $statusValues[] = [
                'value' => $status->value,
                'name' => TypeMealEnum::getLabel($status->value)
            ];
        }
        return $statusValues;
    }

    /**
     * call ajax load data meals by restaurant_id
     */
    public function getMeals(Request $request)
    {
        $meals = $this->restaurantService->getMealsByRestaurantId($request->all());
        return response()->json( ['data'=> $meals]);
    }
}
