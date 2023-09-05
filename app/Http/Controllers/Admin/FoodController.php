<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Services\Interfaces\ISettingFoodService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FoodController extends Controller
{

    protected $settingFoodService;

    public function __construct(
        ISettingFoodService $settingFoodService,

    ) {
        $this->settingFoodService = $settingFoodService;
    }

    /**
     * get blade index list foods
     */
    public function index()
    {
        return view('admin.setting_food.index');
    }


    /**
     * get blade create
     */
    public function getCreate()
    {
        return view('admin.setting_food.create');
    }

    /**
     * create food
     */
    public function postCreate(Request $request)
    {
        $data = $this->settingFoodService->storeFood($request->all());
        if (!$data) {
            // Session::flash('error', "An error occurred, please try again !");
            return response()->json(['error' => 'An error occurred, please try again !']);
        }
        // Return a success
        Session::flash('success', "Store food successfully !");
        return response()->json(['route' => route('admin.setting_food.index')]);
    }

}
