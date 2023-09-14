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

    /**
     * checkbox load data
     */
    public function ajaxCheckbox(Request $request)
    {
        if ($request->outOfStock == 'true'){
            $foods = $this->settingFoodService->getListFoodAjax();
        }else {
            $foods = $this->settingFoodService->getListFood();
        }
        $data = view('admin.setting_food.partials.list',['foods' => $foods])->render();
        return response()->json(['data' => $data, 'foods' => $foods]);
    }


    /**
     * delete food setting by id
     */
    public function delete($id)
    {
        $data = $this->settingFoodService->delete($id);
        if (!$data) {
            // Session::flash('error', "An error occurred, please try again !");
            return response()->json(['error' => 'An error occurred, please try again !']);
        }
        // Return a success
        Session::flash('success', "Delete food successfully !");
        return response()->json(['route' => route('admin.setting_food.index')]);
    }

    /**
     * edit foodSetting by id
     */
    public function edit($id)
    {
        $food = $this->settingFoodService->get($id);
        return view('admin.setting_food.edit', compact('food'));
    }

    /**
     * post edit foodSetting
     */
    public function postEdit(Request $request, $id)
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
        $data = $this->settingFoodService->updateFood($request->all(),$id);
        if (!$data) {
            // Session::flash('error', "An error occurred, please try again !");
            return response()->json(['error' => 'An error occurred, please try again !']);
        }
        // Return a success
        Session::flash('success', "Update food successfully !");
        return response()->json(['route' => route('admin.setting_food.index')]);
    }

}
