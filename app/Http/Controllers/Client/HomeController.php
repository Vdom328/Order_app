<?php

namespace App\Http\Controllers\Client;

use App\Classes\Services\Interfaces\IRestaurantService;
use App\Classes\Services\Interfaces\ISettingFoodService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    protected $restaurantService, $settingFoodService;

    public function __construct(
        IRestaurantService $restaurantService,
        ISettingFoodService $settingFoodService
    ) {
        $this->restaurantService = $restaurantService;
        $this->settingFoodService = $settingFoodService;
    }

    public function index(Request $request)
    {
        $restaurant = $this->restaurantService->getHomeClient($request->all());
        return view('client.home', compact('restaurant'));
    }

    public function getTable()
    {
        return view('client.table.table');
    }

    /**
     * get detail food service
     * @param int $id
     */
    public function getDetailFood(Request $request,  $id)
    {
        $restaurant_meal = $this->restaurantService->getRestaurantMealById($request->restaurant_meal_id);
        $food = $this->settingFoodService->get($id);
        $img = $food->foodImages;
        return view('client.detail.detail-food',compact('food','restaurant_meal','img'));
    }

    /**
     * check time add to cart
     */
    public function checkTimeAddCart(Request $request)
    {
        // check add to cart
        $time = Carbon::now()->format('H:i:s');
        $bool =false;
        $restaurant_meal = $this->restaurantService->getRestaurantMealById($request->restaurant_meal_id);
        if ($restaurant_meal->start_time < $time && $restaurant_meal->end_time > $time) {
            $bool =true;
        }
        return response()->json(['data' => $bool]);
    }

    /**
     * get list cart blade
     *
     */
    public function getListCart()
    {
        return view('client.cart.list-cart');
    }
}
