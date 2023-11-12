<?php
namespace App\Classes\Enum;

use App\Traits\EnumToLabel;


enum CouponTypeEnum: int
{
    use EnumToLabel;
    case PERCENT = 0;
    case PRICE = 1;

    public function label(): string
    {
        return match($this) {
            CouponTypeEnum::PERCENT => 'Percent',
            CouponTypeEnum::PRICE => 'Price',
        };
    }
}
