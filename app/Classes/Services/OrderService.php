<?php

namespace App\Classes\Services;

use App\Classes\Enum\PaymentOrderEnum;
use App\Classes\Enum\StatusOrderEnum;
use App\Classes\Repository\Interfaces\ICouponUserRepository;
use App\Classes\Repository\Interfaces\IOrderFoodRepository;
use App\Classes\Repository\Interfaces\IOrderRepository;
use App\Classes\Repository\Interfaces\ISettingFoodRepository;
use App\Classes\Services\Interfaces\ICouponService;
use App\Classes\Services\Interfaces\IOrderService;
use App\Models\CouponSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService extends BaseService implements IOrderService
{

    protected $orderFoodRepository, $orderRepository, $settingFoodRepository, $couponService, $couponUserRepository;
    public function __construct(
        IOrderFoodRepository $orderFoodRepository,
        IOrderRepository $orderRepository,
        ISettingFoodRepository $settingFoodRepository,
        ICouponService $couponService,
        ICouponUserRepository $couponUserRepository
    )
    {
        $this->orderFoodRepository = $orderFoodRepository;
        $this->orderRepository = $orderRepository;
        $this->settingFoodRepository = $settingFoodRepository;
        $this->couponService = $couponService;
        $this->couponUserRepository = $couponUserRepository;
    }

    /**
     * @inheritDoc
     */
    public function createOrder($attr_cart, $infor_order, $price, $coupon)
    {
        DB::beginTransaction();
        try {

            $code = $this->checkExistCode();
            $attrOrder = [
                'code' => $code,
                'restaurant_id' => $infor_order['restaurant_id'],
                'user_id' =>  Auth::user()->id,
                'table_id' => $infor_order['table_id'],
                'time_order' => Carbon::now()->format('Y-m-d H:i:s'),
                'payment' => PaymentOrderEnum::CASH->value,
                'status' => StatusOrderEnum::PENDING->value,
                'total_price' => $price,
            ];

            $createOrder = $this->orderRepository->create($attrOrder);

            //create coupon
            if ($coupon != null || $coupon != '') {
                $coupon = CouponSetting::where('code', $coupon)->first();
                $attrCoupon = [
                    'user_id' => Auth::user()->id,
                    'coupon_id' => $coupon->id,
                    'order_id' => $createOrder->id,
                    'price' => $price,
                ];

                $createCoupon = $this->couponUserRepository->create($attrCoupon);
            }

            $attrOrderFood = [];
            foreach ($attr_cart as $value) {
                $food = $this->settingFoodRepository->find($value['food_id']);
                $attrOrderFood[] = [
                    'order_id' => $createOrder->id,
                    'food_id' => $value['food_id'],
                    'quantity' => $value['quantity'],
                    'price' => $food->price,
                ];
            }
            $this->orderFoodRepository->insert($attrOrderFood);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create order client : ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function getOrders($data)
    {
        return $this->orderRepository->getOrders($data);
    }

    /**
     * @inheritDoc
     */
    public function getOrderById($id)
    {
        return $this->orderRepository->find($id);
    }

    /**
     * @inheritDoc
     */
    public function createOrderByAdmin($data)
    {
        DB::beginTransaction();
        try {

            $code = $this->checkExistCode();
            $user_id = null;
            $time_order = Carbon::now()->format('Y-m-d H:i:s');
            // check order
            if (isset($data['id'])) {
                $order = $this->orderRepository->find($data['id']);
                $code = $order->code;
                $user_id = $order->user_id;
                $time_order = $order->time_order;
            }
            $attrOrder = [
                'code' => $code,
                'restaurant_id' => $data['restaurant_id'],
                'user_id' =>  $user_id,
                'table_id' => $data['table_id'],
                'time_order' => $time_order,
                'payment' => $data['payment'],
                'status' => $data['status'],
            ];

            if (isset($data['id'])) {
                $createOrder = $this->orderRepository->update($data['id'], $attrOrder);
                $order_id = $data['id'];
            }else{
                $createOrder = $this->orderRepository->create($attrOrder);
                $order_id = $createOrder->id;
            }

            $attrOrderFood = [];
            foreach ($data['order_food'] as $value) {
                $food = $this->settingFoodRepository->find($value['food_id']);
                $attr = [
                    'order_id' => $order_id,
                    'food_id' => $value['food_id'],
                    'quantity' => $value['quantity'],
                    'price' => $food->price,
                ];
                if (isset($value['id'])) {
                    $this->orderFoodRepository->update($value['id'], $attr);
                }else{
                    $attrOrderFood[] = $attr;
                }
            }
            $this->orderFoodRepository->insert($attrOrderFood);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create order client : ' . $e->getMessage());
            return false;
        }
    }

    /**
     * check code order
     */
    public function checkExistCode()
    {
        // If the number is not unique, generate a new one
        for ($code = 1; $code <= 99999; $code++) {
            $exists = $this->orderRepository->exists($code);
            if (!$exists) {
                $code = str_pad($code, 5, '0', STR_PAD_LEFT);
                break;
            }
        }
        return $code;
    }

    /**
     * @inheritDoc
     */
    public function deleteOrderById($id)
    {
        $this->orderRepository->delete($id);
        return $this->orderFoodRepository->deleteByOrderId($id);
    }

    /**
     * @inheritDoc
     */
    public function getHistoryByUser($user_id)
    {
        return $this->orderRepository->getHistoryByUser($user_id);
    }
}
