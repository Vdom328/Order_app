<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Enum\PaymentOrderEnum;
use App\Classes\Enum\StatusOrderEnum;
use App\Classes\Services\Interfaces\IOrderService;
use App\Classes\Services\Interfaces\IRestaurantService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService, $restaurantService;

    public function __construct(
        IOrderService $orderService,
        IRestaurantService $restaurantService
    ) {
        $this->orderService = $orderService;
        $this->restaurantService = $restaurantService;
    }

    /**
     * return blade list order information
     */
    public function index(Request $request)
    {
        $orders = $this->orderService->getOrders($request->all());
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * get order by id
     */
    public function getOrder(Request $request)
    {
        $order = $this->orderService->getOrderById($request->id);
        $restaurants = $this->restaurantService->getRestaurants();
        $status = $this->getStatus();
        $payments =  $this->getPayments();
        $html = view('admin.orders.partials._modal-edit',compact('order','restaurants','status','payments'))->render();
        return response()->json([$restaurants, 'html' => $html]);
    }

    /**
     * Get status default
     */
    public function getStatus(): array
    {
        $statusValues = [];
        $statusCases = StatusOrderEnum::cases();
        foreach ($statusCases as $status) {
            $statusValues[] = [
                'value' => $status->value,
                'name' => StatusOrderEnum::getLabel($status->value)
            ];
        }
        return $statusValues;
    }


     /**
     * Get payments default
     */
    public function getPayments(): array
    {
        $statusValues = [];
        $statusCases = PaymentOrderEnum::cases();
        foreach ($statusCases as $status) {
            $statusValues[] = [
                'value' => $status->value,
                'name' => PaymentOrderEnum::getLabel($status->value)
            ];
        }
        return $statusValues;
    }
}
