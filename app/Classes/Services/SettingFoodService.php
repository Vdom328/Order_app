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
        if (!Storage::exists('public/food_images')) {
            // Tạo mới thư mục avatarUser
            Storage::makeDirectory('public/food_images');
        }
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
}
