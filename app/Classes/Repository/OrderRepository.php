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

}
