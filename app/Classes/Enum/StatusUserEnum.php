<?php
namespace App\Classes\Enum;

use App\Traits\EnumToLabel;

/**
 * 0:男性, 1:女性
 */
enum StatusUserEnum: int
{
    use EnumToLabel;
    case Active = 1;
    case Inactive = 2;

}
