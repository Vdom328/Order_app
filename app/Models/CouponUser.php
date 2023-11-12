<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponUser extends Model
{
    use HasFactory, SoftDeletes;
    public $table = "coupon_user";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function coupon()
    {
        return $this->belongsTo(CouponSetting::class, 'coupon_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
