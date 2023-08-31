<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IFoodImagesRepository;
use App\Classes\Repository\Interfaces\ISettingFoodRepository;
use App\Classes\Services\Interfaces\ISettingFoodService;

class SettingFoodService extends BaseService implements ISettingFoodService
{

    protected
        $foodImagesRepository,
        $settingFoodRepository;
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
        ];
        $data = $this->settingFoodRepository->create($attr);
    }

    /**
     * update images storage
     * @param array $data
     * @param int $id
     * @return array
     */
    public function updateImagesStorage($data, $id)
    {
        $attribute = [];
        foreach ($data as $img) {
            if ($img && $img->hasFile() && $img->isValid()) {
                $imageName = time() . '_' . uniqid() . '.' . $img->extension();
                $img->storeAs('food_images', $imageName, 'disk_name');
                $attribute[] = [
                    'id' => $id,
                    'image' => $imageName
                ];
            }
        }
        return $attribute;
    }
}
