<?php

namespace App\Classes\Repository\Interfaces;


interface IOrderFoodRepository extends IBaseRepository
{
    /**
     * delete by order_id
     * @param int $orderId
     */
    public function deleteByOrderId($orderId);
}
