<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IFoodImagesRepository;
use App\Classes\Repository\Interfaces\ISettingFoodRepository;
use App\Classes\Services\Interfaces\ISettingFoodService;
use Illuminate\Support\Facades\Storage;

class SettingFoodService extends BaseService implements ISettingFoodService
{

    protected $foodImagesRepository, $settingFoodRepository;
    public function __construct(
        ISettingFoodRepository $settingFoodRepository,
        IFoodImagesRepository $foodImagesRepository,
    )
    {
        $this->settingFoodRepository = $settingFoodRepository;
        $this->foodImagesRepository = $foodImagesRepository;
    }

    /**
     *
     */
    public function storeFood($data)
    {
        $attr = [
            'name' => $data['name'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'status' => $data['status'],
            'memo' => $data['memo'],
        ];
        $food_setting = $this->settingFoodRepository->create($attr);
        return $this->createImagesStorage($data['images'],$food_setting->id);
    }

    /**
     * update images storage
     * @param array $data
     * @param int $food_id
     *
     */
    public function createImagesStorage($data, $food_id)
    {
        $attribute = [];
        foreach ($data as $img) {
            if ($img) {
                $imageName = time() . '_' . uniqid() . '.' . $img->extension();
                $img->storeAs('public/food_images/', $imageName);
                $attribute[] = [
                    'food_id' => $food_id,
                    'image' => $imageName
                ];
            }
        }
        return $this->foodImagesRepository->insert($attribute);
    }

    /**
     * get list food
     */
    public function getListFood()
    {
        return $this->settingFoodRepository->all();
    }

    /**
     * get list food quantity > 0
     */
    public function getListFoodAjax(){
        return $this->settingFoodRepository->getListFoodAjax();
    }

    /**
     * delete by id
     * @param int  $id
     */
    public function delete($id)
    {
        return $this->settingFoodRepository->delete($id);
    }

    /**
     * get by id
     */
    public function get($id)
    {
        return $this->settingFoodRepository->find($id);
    }


    /**
     * update food by id
     * @param int $id
     * @param array $data
     */
    public function updateFood($data,$id)
    {
        $attr = [
            'name' => $data['name'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'status' => $data['status'],
            'memo' => $data['memo'],
        ];
        $food_setting = $this->settingFoodRepository->update($id,$attr);
        $deleteImages = $this->foodImagesRepository->deleteByFoodId($id);
        $images =  $this->createImagesStorage($data['images'],$id);
        return $images;
    }
}
