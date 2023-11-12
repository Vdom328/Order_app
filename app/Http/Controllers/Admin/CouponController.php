<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Services\Interfaces\ICouponService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
    public function index(Request $request)
    {
        $coupons = $this->couponService->gesListCoupon($request->all());
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * create new coupon
     *
     */
    public function createCoupon(CouponRequest $request)
    {
        $create = $this->couponService->createCoupon($request->all());
        $coupons = $this->couponService->gesListCoupon($request->all());
        $html = view('admin.coupon.partials._list', compact('coupons'))->render();
        if (!$create) {
            Session::flash('error', "An error occurred, please try again !");
            return redirect()->back();
        }
        // Return a success
        Session::flash('success', "Create coupon successfully !");
        return response()->json($html);
    }

    /**
     * delete coupon
     */
    public function deleteCoupon($id)
    {
        $delete = $this->couponService->deleteCouponById($id);
        if (!$delete) {
            Session::flash('error', "An error occurred, please try again !");
            return redirect()->back();
        }
        // Return a success
        Session::flash('success', "Delete coupon successfully !");
        return redirect()->route('admin.coupons');
    }

    /**
     * get edit coupon
     */
    public function editCoupon(Request $request)
    {
        $coupon = $this->couponService->getCouponById($request->id);
        $html = view('admin.coupon.partials._modal',compact('coupon'))->render();
        return response()->json($html);
    }
}
