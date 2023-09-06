<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Services\Interfaces\ISettingFoodService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
        $foods = $this->settingFoodService->getListFood();
        return view('admin.setting_food.index',compact('foods'));
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
        $rules = [
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
            'status' => 'required|integer',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors(); // Get errors
            $errorMsgs = json_decode($errors); // Convert errors to JSON
            return response()->json(['errors' => $errorMsgs], 422); // Return errors in JSON format
        }
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
