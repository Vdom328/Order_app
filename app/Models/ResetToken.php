<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetToken extends Model
{
    use HasFactory;
    public $table = "password_reset_tokens";
    protected $guarded = [];
}
