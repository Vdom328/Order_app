<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    use HasFactory;

    public $table = "restaurant_table";
    protected $guarded = [];

    public function restaurant()
    {
        return $this->belongsTo(RestaurantSetting::class, 'restaurant_id');
    }
}
