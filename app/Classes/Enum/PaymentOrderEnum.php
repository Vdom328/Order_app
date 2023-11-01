<?php
namespace App\Classes\Enum;

use App\Traits\EnumToLabel;

/**
 * 0:男性, 1:女性
 */
enum PaymentOrderEnum: int
{
    use EnumToLabel;
    case CARD = 0;
    case CASH = 1;

    public function label(): string
    {
        return match($this) {
            PaymentOrderEnum::CASH => 'CASH',
            PaymentOrderEnum::CARD => 'CARD',
        };
    }
}
