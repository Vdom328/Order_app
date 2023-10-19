<?php

namespace App\Classes\Enum;

use App\Traits\EnumToLabel;

/**
 * 0:男性, 1:女性
 */
enum TypeMealEnum: int
{
    use EnumToLabel;
    case MORNING = 1;
    case NOON  = 2;
    case DARK_NIGHT = 3;

    public function label(): string
    {
        return match($this) {
            TypeMealEnum::MORNING => 'Morning',
            TypeMealEnum::NOON => 'Noon',
            TypeMealEnum::DARK_NIGHT => 'Dark night',
        };
    }
}
