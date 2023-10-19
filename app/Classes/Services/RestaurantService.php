<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IRestaurantMealRepository;
use App\Classes\Repository\Interfaces\IRestaurantSettingRepository;
use App\Classes\Services\Interfaces\IRestaurantService;
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
        return $this->IRestaurantSettingRepository->create($attr);
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
}
