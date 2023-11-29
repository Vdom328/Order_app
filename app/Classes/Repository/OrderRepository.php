<?php

namespace App\Classes\Repository;

use App\Classes\Enum\StatusOrderEnum;
use App\Classes\Repository\Interfaces\IOrderRepository;
use App\Models\Order;
use Carbon\Carbon;

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

    /**
     * @inheritDoc
     */
    public function findByDate($date)
    {
        $query = $this->model;
        return $query->whereDate('time_order', $date)->get();
    }

    /**
     * @inheritDoc
     */
    public function findByMonth($month)
    {
        $query = $this->model;
        return $query->whereYear('time_order', '=', Carbon::parse($month)->year)
                        ->whereMonth('time_order', '=', Carbon::parse($month)->month)
                        ->get();
    }

    /**
     * @inheritDoc
     */
    public function findByYear($year)
    {
        $query = $this->model;

        return $query->whereYear('time_order', '=', $year)->get();
    }

    /**
     * @inheritDoc
     */
    public function getHistoryByUser($user_id)
    {
        return Order::where('user_id', $user_id)->where('status',StatusOrderEnum::PAID->value)->get();
    }
}
