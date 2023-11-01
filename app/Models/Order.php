<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    public $table = "order";
    protected $guarded = [];

    public function restaurant()
    {
        return $this->belongsTo(RestaurantSetting::class, 'restaurant_id');
    }

    public function order_food()
    {
        return $this->hasMany(OrderFood::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
