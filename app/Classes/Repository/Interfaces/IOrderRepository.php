<?php

namespace App\Classes\Repository\Interfaces;


interface IOrderRepository extends IBaseRepository
{
    /**
     * exists code
     */
    public function exists($code);

    /**
     * get order by data
     * @param array $data
     */
    public function getOrders($data);
}
