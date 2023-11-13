<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IOrderFoodRepository;
use App\Classes\Repository\Interfaces\IOrderRepository;
use App\Classes\Services\Interfaces\IHomeService;
use App\Models\Order;
use Carbon\Carbon;

class HomeService extends BaseService implements IHomeService
{

    protected $orderFoodRepository, $orderRepository, $settingFoodRepository;
    public function __construct(
        IOrderFoodRepository $orderFoodRepository,
        IOrderRepository $orderRepository,
    ) {
        $this->orderFoodRepository = $orderFoodRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @inheritDoc
     */
    public function dataChartOrder()
    {
        $orderDay = $this->dataChartOrderDay();

        $orderMonth = $this->dataChartOrderMonth();

        $orderYear = $this->dataChartOrderYear();

        $orderLast10Years = $this->dataChartOrderLast10Years();

        return [
            "orderDay"=> $orderDay['data'],
            "totalCountOrder"=> $orderDay['totalCount'],
            "totalPriceOrder"=> $orderDay['totalPrice'],
            "orderMonth"=> $orderMonth,
            "orderYear"=> $orderYear,
            "orderLast10Years"=> $orderLast10Years
        ];
    }

    /**
     * data chart order day
     */
    private function dataChartOrderDay()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $data = [];
        $totalCount = 0; // Initialize the total count variable
        $totalPrice = 0;

        for ($i = 0; $i < 7; $i++) {
            $currentDate = $startOfWeek->copy()->addDays($i);
            $dailyData = $this->orderRepository->findByDate($currentDate->toDateString());

            $dailyTotalValue = $dailyData->flatMap->order_food->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            $dailyCount = $dailyData->count(); // Count for the current day
            $totalCount += $dailyCount; // Increment the total count
            $totalPrice += $dailyTotalValue;
            $data[] = [
                'date' => $currentDate->format('D'),
                'value' => $dailyTotalValue,
                'count' => $dailyCount,
            ];
        }

        // Add the total count to the returned data

        return ['data' => $data, 'totalCount' => $totalCount, 'totalPrice' => $totalPrice];
    }

    /**
     * data chart order month
     */
    private function dataChartOrderMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $data = [];
        for ($i = 0; $i < $startOfMonth->daysInMonth; $i++) {
            $currentDate = $startOfMonth->copy()->addDays($i);
            $monthlyData = $this->orderRepository->findByDate($currentDate->toDateString());
            // Calculate the sum of 'price * quantity' for the day
            $dailyTotalValue = $monthlyData->flatMap->order_food->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            $data[] = [
                'date' => $currentDate->format('d'),
                'value' => $dailyTotalValue,
            ];
        }

        return $data;
    }

    /**
     * Data chart order year
     */
    private function dataChartOrderYear()
    {
        $startOfYear = Carbon::now()->startOfYear();
        $data = [];
        for ($i = 0; $i < 12; $i++) {
            $currentMonth = $startOfYear->copy()->addMonths($i);
            $monthlyData = $this->orderRepository->findByMonth($currentMonth->format('Y-m'));
            $dailyTotalValue = $monthlyData->flatMap->order_food->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $data[] = [
                'month' => $currentMonth->format('F'),
                'value' => $dailyTotalValue,
            ];
        }

        return $data;
    }

    /**
     * data chart order year month
     */
    private function dataChartOrderLast10Years()
    {
        $startOfYear = Carbon::now()->startOfYear();
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $currentYear = $startOfYear->copy()->subYears($i);
            $yearlyData = $this->orderRepository->findByYear($currentYear->format('Y'));
            $dailyTotalValue = $yearlyData->flatMap->order_food->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $data[] = [
                'year' => $currentYear->format('Y'),
                'value' => $dailyTotalValue,
            ];
        }

        return $data;
    }
}
