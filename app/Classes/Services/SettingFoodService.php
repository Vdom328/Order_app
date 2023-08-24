<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IFoodIngredientRepository;
use App\Classes\Repository\Interfaces\IIngredientRepository;
use App\Classes\Repository\Interfaces\ISettingFoodRepository;
use App\Classes\Services\Interfaces\ISettingFoodService;

class SettingFoodService extends BaseService implements ISettingFoodService
{

    protected
        $settingFoodRepository,
        $ingredientRepository,
        $foodIngredientRepository;

    public function __construct(
        ISettingFoodRepository $settingFoodRepository,
        IIngredientRepository $ingredientRepository,
        IFoodIngredientRepository $foodIngredientRepository,
    )
    {
        $this->settingFoodRepository = $settingFoodRepository;
        $this->ingredientRepository = $ingredientRepository;
        $this->foodIngredientRepository = $foodIngredientRepository;
    }


    /**
     * Create Ingredient
     * @param array $data
     */
    public function getCreateIngredient(Array $data)
    {
        $attributes = [];
        foreach ($data['formDataArray'] as $item) {
            $dataItem = [
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'status' => $item['status']
            ];
            if ($item['id']) {
                $this->ingredientRepository->update($item['id'],$dataItem);
            }else{
                $attributes[] = $dataItem;
            }
        }
        return $this->ingredientRepository->insert($attributes);
    }

    /**
     * delete Ingredient
     * @param int $data
     */
    public function deleteIngredientById(int $id)
    {
        return $this->ingredientRepository->delete($id);
    }

    /**
     *
     */
    public function getIngredient()
    {
        return $this->ingredientRepository->all();
    }
}
