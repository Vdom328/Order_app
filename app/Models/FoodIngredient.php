<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodIngredient extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function settingFood()
    {
        return $this->hasMany(SettingFood::class);
    }
}
