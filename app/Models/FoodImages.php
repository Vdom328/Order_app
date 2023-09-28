<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodImages extends Model
{
    use HasFactory;
    public $table = "food_images";
    protected $guarded = [];

}
