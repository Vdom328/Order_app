<?php

namespace App\Classes\Services;

use App\Classes\Enum\CouponTypeEnum;
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

    /**
     * @inheritDoc
     */
    public function createCoupon(array $data)
    {
        $code = $data["code"];
        if (!isset($data["code"])) {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $code = substr(str_shuffle($characters), 0, 10);
            $existingCode = $this->couponSettingRepository->findOne(['code' => $code]);
            // If code already exists, generate a new one
            while ($existingCode) {
                $code = substr(str_shuffle($characters), 0, 10);
                $existingCode = $this->couponSettingRepository->findOne(['code' => $code]);
            }

        }
        $attr = [
            "code"=> $code,
            "percent"=> $data["percent"],
            "price"=> $data["price"],
            "type"=> $data["type"],
            "status"=> $data["status_coupon"],
            "memo"=> $data["memo"],
        ];
        if (isset($data["id"])) {
            return $this->couponSettingRepository->update($data["id"],$attr);
        }
        return $this->couponSettingRepository->create($attr);
    }

    /**
     * @inheritDoc
     */
    public function gesListCoupon($data)
    {
        return $this->couponSettingRepository->all();
    }

    /**
     * @inheritDoc
     */
    public function deleteCouponById($id)
    {
        return $this->couponSettingRepository->delete($id);
    }

    /**
     * @inheritDoc
     */
    public function getCouponById($id)
    {
        return $this->couponSettingRepository->findOne(["id"=> $id]);
    }

    /**
     * @inheritDoc
     */
    public function newPriceOrderByCoupon($data)
    {
        // check coupon
        $coupons = $this->couponSettingRepository->whereParam('code', $data['coupon']);
        if ($coupons->count() <= 0) {
            return false;
        }
        $coupon = $coupons->first();
        if ($coupon->status == 0){
            return false;
        }
        $totalPrice = $data['totalPrice'];
        if ($totalPrice < 0) {
            return false;
        }
        if ($coupon->type == CouponTypeEnum::PRICE->value) {
            $priceCoupon = $coupon->price;
            if ($totalPrice < $priceCoupon) {
                return 'Total price: '. number_format($totalPrice) .'$';
            }
            $newPrice = $totalPrice - $priceCoupon;
        }else{
            $priceCoupon = $totalPrice*$coupon->percent/100;
            $newPrice = $totalPrice - (int)$priceCoupon;
        }
        $text = 'Total price: '. number_format($totalPrice) . '$ - '. number_format($priceCoupon) .'$ = '.number_format($newPrice).'$';
        return $text;
    }

    /**
     * @inheritDoc
     */
    public function orderCoupon($price, $coupon)
    {
        // check coupon
        $coupons = $this->couponSettingRepository->whereParam('code', $coupon);
        if ($coupons->count() <= 0) {
            return false;
        }
        $coupon = $coupons->first();
        if ($coupon->status == 0){
            return false;
        }
        if ($price < 0) {
            return false;
        }
        if ($coupon->type == CouponTypeEnum::PRICE->value) {
            $priceCoupon = $coupon->price;
            if ($price < $priceCoupon) {
                return $price;
            }
            $newPrice = $price - $priceCoupon;
        }else{
            $priceCoupon = $price*$coupon->percent/100;
            $newPrice = $price - (int)$priceCoupon;
        }
        return $newPrice;
    }
}
