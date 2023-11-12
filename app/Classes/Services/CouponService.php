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
}
