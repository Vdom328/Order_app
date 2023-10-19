<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Enum\StatusUserEnum;
use App\Classes\Enum\TypeMealEnum;
use App\Classes\Services\Interfaces\IRestaurantService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRestaurantSettingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RestaurantController extends Controller
{

    protected $restaurantService;

    public function __construct(
        IRestaurantService $restaurantService

    ) {
        $this->restaurantService = $restaurantService;
    }

    /**
     * get update restaurant settings
     */
    public function restaurant_setting()
    {
        $typeMeals = $this->getStatus();
        return view('admin.restaurant_setting.create', compact('typeMeals'));
    }

    /**
     * post update restaurant settings
     */
    public function postUpdate(CreateRestaurantSettingRequest $request)
    {
        $restaurant =  $this->restaurantService->postUpdate($request->all());
        if (!$restaurant) {
            Session::flash('error', "An error occurred, please try again !");
            return redirect()->route('admin.role.list');
        }
        // Return a success
        Session::flash('success', "Create restaurant successfully !");
        return redirect()->route('admin.restaurant.index');
    }

    /**
     * get index restaurant
     */

     public function index()
     {
        $restaurants = $this->restaurantService->getRestaurants();
        return view('admin.restaurant_setting.index', compact('restaurants'));
     }

     /**
      * get update restaurant
      * @param int $id
      */
    public function update($id)
    {
        $typeMeals = $this->getStatus();
        $restaurant = $this->restaurantService->findRestaurantById($id);
        return view('admin.restaurant_setting.update', compact('restaurant','typeMeals'));
    }

    /**
     * delete restaurant by id
     */
    public function delete($id)
    {
        $restaurant =  $this->restaurantService->delete($id);
        if (!$restaurant) {
            Session::flash('error', "An error occurred, please try again !");
            return response()->json();
        }
        // Return a success
        Session::flash('success', "Delete restaurant successfully !");
        return response()->json();
    }

        /**
     * Get status default in project
     */
    public function getStatus(): array
    {
        $statusValues = [];
        $statusCases = TypeMealEnum::cases();
        foreach ($statusCases as $status) {
            $statusValues[] = [
                'value' => $status->value,
                'name' => TypeMealEnum::getLabel($status->value)
            ];
        }
        return $statusValues;
    }
}
