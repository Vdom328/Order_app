<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IRestaurantMealRepository;
use App\Classes\Repository\Interfaces\IRestaurantSettingRepository;
use App\Classes\Services\Interfaces\IRestaurantService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RestaurantService extends BaseService implements IRestaurantService
{
    protected  $IRestaurantSettingRepository, $restaurantMealRepository;

    public function __construct(
        IRestaurantSettingRepository $IRestaurantSettingRepository,
        IRestaurantMealRepository $restaurantMealRepository
    )
    {
        $this->IRestaurantSettingRepository = $IRestaurantSettingRepository;
        $this->restaurantMealRepository = $restaurantMealRepository;
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
                    $item = $this->IRestaurantSettingRepository->find($data['id']);
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
            ];
            if ($data['id'] != '' || $data['id'] != null) {
                return $this->IRestaurantSettingRepository->update($data['id'],$attr);
            }
            $restaurantSetting = $this->IRestaurantSettingRepository->create($attr);
            // add meal
            if ($data['id'] != '' || $data['id'] != null) {
                $mealDelete = $this->restaurantMealRepository->deleteByRestaurantId($data['id']);
            }
            $attrMeal = [];
            foreach ($data['meal'] as $meal ) {
                $attrMeal[] = [
                    'restaurant_id' => $restaurantSetting->id,
                    'meal' => $meal,
                ];
            }
            $meals = $this->restaurantMealRepository->insert($attrMeal);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create customer: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function getRestaurants()
    {
        return $this->IRestaurantSettingRepository->all();
    }

    /**
     * @inheritDoc
     */
    function findRestaurantById($id)
    {
        return $this->IRestaurantSettingRepository->find($id);
    }


    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        return $this->IRestaurantSettingRepository->delete($id);
    }

    /**
     * @inheritDoc
     */
    public function getMealsByRestaurantId($data)
    {
        return $this->restaurantMealRepository->whereParam('restaurant_id', $data['restaurant_id']);
    }
}
