<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IRestaurantFoodRepository;
use App\Classes\Repository\Interfaces\IRestaurantMealRepository;
use App\Classes\Repository\Interfaces\IRestaurantSettingRepository;
use App\Classes\Services\Interfaces\IRestaurantService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RestaurantService extends BaseService implements IRestaurantService
{
    protected  $restaurantSettingRepository, $restaurantMealRepository, $restaurantFoodRepository;

    public function __construct(
        IRestaurantSettingRepository $restaurantSettingRepository,
        IRestaurantMealRepository $restaurantMealRepository,
        IRestaurantFoodRepository $restaurantFoodRepository
    )
    {
        $this->restaurantSettingRepository = $restaurantSettingRepository;
        $this->restaurantMealRepository = $restaurantMealRepository;
        $this->restaurantFoodRepository = $restaurantFoodRepository;
    }

    /**
     * create or update restaurant setting
     * @param array $data
     */
    public function postUpdate($data)
    {
        DB::beginTransaction();
        try {
            $logo = null;
            if ($data['logo']) {
                if ($data['id'] != '' || $data['id'] != null) {
                    $item = $this->restaurantSettingRepository->find($data['id']);
                    Storage::delete('public/logo/' . $item->logo);
                }
                $imageName = uniqid() . '.' . $data['logo']->extension();
                $data['logo']->storeAs('public/logo/', $imageName);
                $logo = $imageName;
            }
            $attr = [
                "name" => $data['name'],
                "start_time" =>$data['start_time'],
                "end_time" => $data['end_time'],
                "email" => $data['email'],
                "address" => $data['address'],
                "phone" => $data['phone'],
                "maps" => $data['maps'],
                "status" => $data['status'],
                "logo" => $logo,
                'quantity_table' => $data['quantity_table'],
            ];
            if ($data['id'] != '' || $data['id'] != null) {
                $this->restaurantSettingRepository->update($data['id'],$attr);
                $restaurantSetting_id = $data['id'];
            }else{
                $restaurantSetting = $this->restaurantSettingRepository->create($attr);
                $restaurantSetting_id = $restaurantSetting->id;
            }
            // add meal
            if ($data['id'] != '' || $data['id'] != null) {
                $mealDelete = $this->restaurantMealRepository->deleteByRestaurantId($data['id']);
            }
            $attrMeal = [];
            foreach ($data['meal'] as $meal ) {
                $attrMeal[] = [
                    'restaurant_id' => $restaurantSetting_id,
                    'meal' => $meal,
                ];
            }
            $meals = $this->restaurantMealRepository->insert($attrMeal);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create : ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function getRestaurants()
    {
        return $this->restaurantSettingRepository->all();
    }

    /**
     * @inheritDoc
     */
    function findRestaurantById($id)
    {
        return $this->restaurantSettingRepository->find($id);
    }


    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        return $this->restaurantSettingRepository->delete($id);
    }

    /**
     * @inheritDoc
     */
    public function getMealsByRestaurantId($data)
    {
        return $this->restaurantMealRepository->whereParam('restaurant_id', $data['restaurant_id']);
    }

    /**
     * @inheritDoc
     */
    public function createRestaurantFood($data){
        DB::beginTransaction();
        try {
            $restaurant_meal = $this->restaurantMealRepository->findOne(['restaurant_id' => $data['restaurant_id'], 'meal' => $data['type_meal']]);
            if (!$restaurant_meal) {
                return false;
            };
            // update restaurant_meal
            $attrMeals = [
                'start_time' =>  $data['start_time'],
                'end_time' =>  $data['end_time'],
            ];
            $restaurant_meal_update = $this->restaurantMealRepository->update($restaurant_meal->id, $attrMeals);
            $deleteFood = $this->restaurantFoodRepository->deleteByRestaurantMealId($restaurant_meal->id);
            $attr = [];
            foreach ($data['food_id'] as $food_id) {
                $attr[] = [
                    'restaurant_meal_id' => $restaurant_meal->id,
                    'food_id' => $food_id,
                ];
            }
            $this->restaurantFoodRepository->insert($attr);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create restaurant food : ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function getRestaurantMeals($data)
    {
        $restaurant_meal = $this->restaurantMealRepository->findOne(['restaurant_id' => $data['restaurant_id'], 'meal' => $data['type_meal']]);
        return $restaurant_meal;
    }

    /**
     * @inheritDoc
     */
    public function getHomeClient($data)
    {
        return $this->restaurantSettingRepository->find($data['restaurant_id']);
    }

    /**
     * @inheritDoc
     */
    public function getRestaurantMealById($id)
    {
        return $this->restaurantMealRepository->find($id);
    }

}
