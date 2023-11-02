<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantSetting extends Model
{
    use HasFactory;
    public $table = "restaurant_setting";
    protected $guarded = [];

    public function restaurantMeal()
    {
        return $this->hasMany(RestaurantMeal::class, 'restaurant_id');
    }

    public function restaurant_table()
    {
        return $this->hasMany(RestaurantTable::class, 'restaurant_id');
    }
}
