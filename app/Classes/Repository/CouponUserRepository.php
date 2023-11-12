<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ICouponUserRepository;
use App\Models\CouponUser;

class CouponUserRepository  extends BaseRepository implements ICouponUserRepository
{

    public function model()
    {
        return CouponUser::class;
    }

}
