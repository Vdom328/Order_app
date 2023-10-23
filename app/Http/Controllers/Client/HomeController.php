<?php

namespace App\Http\Controllers\Client;

use App\Classes\Services\Interfaces\IRestaurantService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    protected $restaurantService;

    public function __construct(
        IRestaurantService $restaurantService
    ) {
        $this->restaurantService = $restaurantService;
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
}
