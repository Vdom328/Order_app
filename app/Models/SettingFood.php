<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingFood extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function foodImages()
    {
        return $this->belongsTo(FoodImages::class);
    }
}
