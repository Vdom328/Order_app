<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IFoodImagesRepository;
use App\Models\FoodImages;
use Illuminate\Support\Facades\Storage;

class FoodImagesRepository  extends BaseRepository implements IFoodImagesRepository
{

    public function model()
    {
        return FoodImages::class;
    }

    public function deleteByFoodId($food_id)
    {
        $images = FoodImages::where('food_id', $food_id)->get();
        foreach ($images as $image)
        {
            Storage::delete('public/food_images/' . $image->image);
            $image->delete();
        }
        return true;
    }

}
