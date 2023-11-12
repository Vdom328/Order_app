<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ICouponSettingRepository;
use App\Models\CouponSetting;

class CouponSettingRepository  extends BaseRepository implements ICouponSettingRepository
{

    public function model()
    {
        return CouponSetting::class;
    }

}
