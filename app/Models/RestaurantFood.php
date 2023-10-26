<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantFood extends Model
{
    use HasFactory;
    public $table = "restaurant_food";
    protected $guarded = [];

    public function restaurantMeal()
    {
        return $this->belongsTo(RestaurantMeal::class, 'restaurant_meal_id');
    }

    public function food_setting()
    {
        return $this->belongsTo(SettingFood::class, 'food_id');
    }
}
