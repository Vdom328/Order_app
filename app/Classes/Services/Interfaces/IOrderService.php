<?php

namespace App\Classes\Services\Interfaces;

interface IOrderService
{
    /**
     * create order service
     * @param array $attr_cart
     * @param array $infor_order
     */
    public function createOrder($attr_cart, $infor_order);

    /**
     * get order
     * @param array $data
     */
    public function getOrders($data);

    /**
     * get order by id
     * @param int $id
     */
    public function getOrderById($id);
}
