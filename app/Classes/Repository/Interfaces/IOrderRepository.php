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

    /**
     * find by date
     */
    public function findByDate($date);

    /**
     * find by month
     */
    public function findByMonth($month);

    /**
     * find by year
     */
    public function findByYear($year);
}
