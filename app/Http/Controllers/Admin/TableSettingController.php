<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Services\Interfaces\IRestaurantService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableSettingController extends Controller
{

    protected $restaurantService;

    public function __construct(
        IRestaurantService $restaurantService,
    ) {
        $this->restaurantService = $restaurantService;
    }

    /**
     * get list table restaurant
     */
    public function index()
    {
        $list_restaurant = $this->restaurantService->getRestaurants();
        $restaurant = $list_restaurant->first();
        return view('admin.table_setting.index', compact('list_restaurant','restaurant'));
    }
}
