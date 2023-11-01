<?php

namespace App\Http\Controllers\Client;

use App\Classes\Enum\TypeMealEnum;
use App\Classes\Services\Interfaces\IOrderService;
use App\Classes\Services\Interfaces\IRestaurantService;
use App\Classes\Services\Interfaces\ISettingFoodService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    protected $restaurantService, $settingFoodService, $orderService;

    public function __construct(
        IRestaurantService $restaurantService,
        ISettingFoodService $settingFoodService,
        IOrderService $orderService
    ) {
        $this->restaurantService = $restaurantService;
        $this->settingFoodService = $settingFoodService;
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $restaurant = $this->restaurantService->getHomeClient($request->restaurant_id);
        // check time
        $checkTime = $this->checkTimeRestaurant($restaurant->id);
        if ($checkTime['type'] == false) {
            $time_error = $checkTime['time_error'];
            return view('client.error.time',compact('time_error'));
        }
        $data = $request->all();
        return view('client.home', compact('restaurant','data'));
    }


    public function getTable(Request $request)
    {
        $restaurant = $this->restaurantService->getHomeClient($request->restaurant_id);
        return view('client.table.table', compact('restaurant'));
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

    /**
     * get order now
     */
    public function getOrderNow()
    {
        return view('client.order.payment');
    }

    /**
     * get getOrderSuccess
     */
    public function getOrderSuccess(Request $request)
    {
        $attr_cart = json_decode($request->input('attrCart'), true);
        $infor_order = json_decode($request->input('inforOrder'), true);
        // check time restaurant
        $checkTime = $this->checkTimeRestaurant($infor_order['restaurant_id']);
        if ($checkTime['type'] == false) {
            $time_error = $checkTime['time_error'];
            return view('client.error.time',compact('time_error'));
        }
        // create order
        $create_order = $this->orderService->createOrder($attr_cart,$infor_order);
        if ($create_order == false) {
            return view('client.error.error');
        }
        return view('client.order.order_now', compact('attr_cart', 'infor_order'));
    }

    function checkTimeRestaurant($restaurant_id)
    {

        $current_time = now()->format('H:i:s');
        $restaurant = $this->restaurantService->getHomeClient($restaurant_id);
        $time_error = [];

        // Check if the restaurant has specific opening hours defined
        if ($restaurant->start_time && $restaurant->end_time) {
            if ($current_time < $restaurant->start_time || $current_time > $restaurant->end_time) {
                // The current time is outside the restaurant's opening hours
                // $time_error[] = [
                //     'meal' => 'Opening Restaurant',
                //     'start_time' => $restaurant->start_time,
                //     'end_time' => $restaurant->end_time,
                // ];

                // foreach ($restaurant->restaurantMeal as $value) {
                //     $time_error[] = [
                //     'meal' => TypeMealEnum::getLabel($value->meal),
                //     'start_time' => $value->start_time,
                //     'end_time' => $value->end_time,
                //     ];
                // }
                // return ['type' => false , 'time_error' => $time_error];
            }
        }
        return ['type' => true , 'time_error' => []];
    }
}
