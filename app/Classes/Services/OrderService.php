<?php

namespace App\Classes\Services;

use App\Classes\Enum\PaymentOrderEnum;
use App\Classes\Enum\StatusOrderEnum;
use App\Classes\Repository\Interfaces\IOrderFoodRepository;
use App\Classes\Repository\Interfaces\IOrderRepository;
use App\Classes\Repository\Interfaces\ISettingFoodRepository;
use App\Classes\Services\Interfaces\IOrderService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService extends BaseService implements IOrderService
{

    protected $orderFoodRepository, $orderRepository, $settingFoodRepository;
    public function __construct(
        IOrderFoodRepository $orderFoodRepository,
        IOrderRepository $orderRepository,
        ISettingFoodRepository $settingFoodRepository
    )
    {
        $this->orderFoodRepository = $orderFoodRepository;
        $this->orderRepository = $orderRepository;
        $this->settingFoodRepository = $settingFoodRepository;
    }

    /**
     * @inheritDoc
     */
    public function createOrder($attr_cart, $infor_order)
    {
        DB::beginTransaction();
        try {
            // If the number is not unique, generate a new one
            for ($code = 1; $code <= 99999; $code++) {
                $exists = $this->orderRepository->exists($code);
                if (!$exists) {
                    $code = str_pad($code, 5, '0', STR_PAD_LEFT);
                    break;
                }
            }
            $attrOrder = [
                'code' => $code,
                'restaurant_id' => $infor_order['restaurant_id'],
                'user_id' =>  Auth::user()->id,
                'table_id' => $infor_order['table_id'],
                'time_order' => Carbon::now()->format('Y-m-d H:i:s'),
                'payment' => PaymentOrderEnum::CASH->value,
                'status' => StatusOrderEnum::PENDING->value,
            ];

            $createOrder = $this->orderRepository->create($attrOrder);

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
        return $this->orderRepository->all();
    }
}
