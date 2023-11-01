<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Services\Interfaces\IOrderService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(
        IOrderService $orderService
    ) {
        $this->orderService = $orderService;
    }

    /**
     * return blade list order information
     */
    public function index(Request $request)
    {
        $orders = $this->orderService->getOrders($request->all());
        return view('admin.orders.index', compact('orders'));
    }
}
