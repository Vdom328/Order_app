<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantMeal extends Model
{
    use HasFactory;
    public $table = "restaurant_meal";
    protected $guarded = [];

    public function restaurantSetting()
    {
        return $this->belongsTo(RestaurantSetting::class, 'restaurant_id');
    }
}
