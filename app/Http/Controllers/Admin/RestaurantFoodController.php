<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Services\Interfaces\IRestaurantService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantFoodController extends Controller
{

    protected $restaurantService;

    public function __construct(
        IRestaurantService $restaurantService

    ) {
        $this->restaurantService = $restaurantService;
    }

    public function index()
    {
        $restaurant = $this->restaurantService->getRestaurants();
        return view('admin.restaurant_food.index',compact('restaurant'));
    }
}
