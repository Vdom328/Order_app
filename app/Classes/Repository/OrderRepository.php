<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IOrderRepository;
use App\Models\Order;

class OrderRepository  extends BaseRepository implements IOrderRepository
{

    public function model()
    {
        return Order::class;
    }

    public function exists($code)
    {
        $bool =  $this->model->where('code', $code)->exists();
        return $bool;
    }

    /**
     * @inheritDoc
     */
    public function getOrders($data)
    {
        $query = $this->model;

        if (isset($data['restaurant_id'])) {
            $query = $query->where('restaurant_id', $data['restaurant_id']);
        }

        if (isset($data['status'])) {
            $query = $query->where('status', $data['status']);
        }

        if (isset($data['date'])) {
            $query = $query->whereDate('time_order', $data['date']);
        }

        return $query->get();
    }
}
