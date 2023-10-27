<?php

namespace App\Http\Controllers\Client;

use App\Classes\Services\Interfaces\IRestaurantService;
use App\Classes\Services\Interfaces\ISettingFoodService;
use App\Http\Controllers\Controller;
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
    public function getDetailFood($id)
    {
        $food = $this->settingFoodService->get($id);
        return view('client.detail.detail-food',compact('food'));
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
