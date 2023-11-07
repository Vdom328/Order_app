<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Enum\PaymentOrderEnum;
use App\Classes\Enum\StatusOrderEnum;
use App\Classes\Services\Interfaces\IOrderService;
use App\Classes\Services\Interfaces\IRestaurantService;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewOrderAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        if (request()->ajax()) {
            $orders = $this->orderService->getOrders($request->all());
            $html = view('admin.orders.partials._list-order', compact('orders'))->render();
            return response()->json([
                'html' => $html,
            ]);
        }
        $orders = $this->orderService->getOrders($request->all());
        $restaurants = $this->restaurantService->getRestaurants();
        $status = $this->getStatus();
        $payments =  $this->getPayments();
        return view('admin.orders.index', compact('orders','restaurants','status','payments'));
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

    /**
     * change restaurant status
     */
    public function changeRestaurant(Request $request )
    {
        $restaurant = $this->restaurantService->findRestaurantById($request->restaurant_id);
        $html = view('admin.orders.partials._option-table', compact('restaurant'))->render();
        return response()->json(['html' =>  $html]);
    }

    /**
     * adđ new food
     */
    public function addOrderFood(Request $request)
    {
        $restaurant = $this->restaurantService->findRestaurantById($request->restaurant_id);
        $foodCount = $request->foodCount;
        $html = view('admin.orders.partials._option-food', compact('restaurant','foodCount'))->render();
        return response()->json(['html' =>  $html]);
    }

    /**
     * create new order
     *
     */
    public function createNewOrder(NewOrderAdmin $request)
    {
        $create_order = $this->orderService->createOrderByAdmin($request->all());
        if (!$create_order) {
            Session::flash('error', "An error occurred, please try again !");
            return redirect()->route('admin.order.index');
        }
        // Return a success
        Session::flash('success', "Update order successfully !");
        return redirect()->route('admin.order.index');
    }

    /**
     * delete order by id
     */
    public function deleteOrder($id)
    {
        $delete_order = $this->orderService->deleteOrderById($id);
        if (!$delete_order) {
            Session::flash('error', "An error occurred, please try again !");
            return redirect()->route('admin.order.index');
        }
        // Return a success
        Session::flash('success', "Delete order successfully !");
        return redirect()->route('admin.order.index');
    }
}
