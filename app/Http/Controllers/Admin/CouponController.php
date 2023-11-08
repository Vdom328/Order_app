<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Services\Interfaces\ICouponService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $couponService;

    public function __construct(
        ICouponService $couponService,

    ) {
        $this->couponService = $couponService;
    }

    /**
     * get blade coupon
     */
    public function index()
    {
        return view('admin.coupon.index');
    }
}
