<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Services\Interfaces\IHomeService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(
        IHomeService $homeService,

    ) {
        $this->homeService = $homeService;
    }

    /**
     * get blade home
     */
    public function index()
    {
        $order = $this->homeService->dataChartOrder();
        return view('admin.home', compact('order'));
    }

}
