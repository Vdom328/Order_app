<?php

namespace App\Classes\Services\Interfaces;

interface ICouponService
{

    /**
     * get list coupon by data
     * @param array $data
     */
    public function gesListCoupon($data);

    /**
     * create coupon
     * @param array $data
     */
    public function createCoupon(array $data);

    /**
     * delete coupon by id
     * @param int $id
     */
    public function deleteCouponById($id);

    /**
     * get coupon by id
     * @param int $id
     */
    public function getCouponById($id);

    /**
     * newPriceOrderByCoupon
     * @param array $data
     */
    public function newPriceOrderByCoupon($data);

    /**
     * order coupon
     * @param mixed $price
     * @param mixed $coupon
     */
    public function orderCoupon($price, $coupon);
}
