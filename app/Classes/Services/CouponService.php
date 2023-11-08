<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\ICouponSettingRepository;
use App\Classes\Repository\Interfaces\ICouponUserRepository;
use App\Classes\Services\Interfaces\ICouponService;

class CouponService extends BaseService implements ICouponService
{

    protected $couponSettingRepository,  $couponUserRepository;
    public function __construct(
        ICouponSettingRepository $couponSettingRepository,
        ICouponUserRepository $couponUserRepository,
    )
    {
        $this->couponSettingRepository = $couponSettingRepository;
        $this->couponUserRepository = $couponUserRepository;
    }


}
