<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Enum\TypeMealEnum;
use App\Classes\Services\Interfaces\IRestaurantService;
use App\Classes\Services\Interfaces\ISettingFoodService;
use App\Http\Controllers\Controller;
use App\Models\RestaurantMeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        return view('admin.restaurant_food.index', compact('restaurant', 'foods', 'typeMeals'));
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
        if (!$meals instanceof \Illuminate\Support\Collection) {
            throw new \Exception('Invalid meals data');
        }

        $meals = $meals->map(function ($meal) {
            $meal->name = TypeMealEnum::getLabel($meal->meal);
            return $meal;
        });

        $data = view('admin.restaurant_food.partials._option_meals', ['meals' => $meals])->render();

        return response()->json(['data' => $data]);
    }

    /**
     * get check book food restaurant data
     *
     */
    public function getCheckbox(Request $request)
    {
        $foods = $this->settingFoodService->getListFood();

        if (!$foods instanceof \Illuminate\Support\Collection) {
            throw new \Exception('Invalid foods data');
        }

        $restaurantMeals = $this->restaurantService->getRestaurantMeals($request->all());
        $data = view('admin.restaurant_food.partials._list_meals', ['foods' => $foods, 'restaurantMeals' => $restaurantMeals])->render();

        return response()->json(['data' => $data]);
    }

    /**
     * post save food restaurant data to database
     */
    public function postFoodRestaurant(Request $request)
    {
        $create = $this->restaurantService->createRestaurantFood($request->all());
        return response()->json();
    }
}
