<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantFoodController extends Controller
{
    public function index()
    {
        return view('admin.restaurant_food.index');
    }
}
