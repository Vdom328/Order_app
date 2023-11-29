<?php

namespace App\Classes\Services\Interfaces;

interface IOrderService
{
    /**
     * create order service
     * @param array $attr_cart
     * @param array $infor_order
     */
    public function createOrder($attr_cart, $infor_order, $price, $coupon);

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

    /**
     * create new order by admin
     * @param array $data
     */
    public function createOrderByAdmin($data);

    /**
     * delete order by id
     * @param int $id
     */
    public function deleteOrderById($id) ;

    /**
     * get history by user id
     * @param int $user_id
     */
    public function getHistoryByUser($user_id);
}
