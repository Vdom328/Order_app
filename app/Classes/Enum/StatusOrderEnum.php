<?php
namespace App\Classes\Enum;

use App\Traits\EnumToLabel;

/**
 * 0:男性, 1:女性
 */
enum StatusOrderEnum: int
{
    use EnumToLabel;
    case PAID = 1;
    case PENDING = 0;

    public function label(): string
    {
        return match($this) {
            StatusOrderEnum::PAID => 'PAID',
            StatusOrderEnum::PENDING => 'PENDING',
        };
    }
}
