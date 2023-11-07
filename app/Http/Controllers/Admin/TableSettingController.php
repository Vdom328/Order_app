<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Services\Interfaces\IRestaurantService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class TableSettingController extends Controller
{

    protected $restaurantService;

    public function __construct(
        IRestaurantService $restaurantService,
    ) {
        $this->restaurantService = $restaurantService;
    }

    /**
     * get list table restaurant
     */
    public function index()
    {
        $list_restaurant = $this->restaurantService->getRestaurants();
        $restaurant = $list_restaurant->first();
        return view('admin.table_setting.index', compact('list_restaurant','restaurant'));
    }

    /**
     * create qr code
     * composer require simplesoftwareio/simple-qrcode
     */
    public function createQrCode(Request $request)
    {
        $url = 'https://example.com';
        $qrCode = QrCode::size(300)->generate($url);

        $filename = 'qr_code.svg';
        $path = 'qr_codes/' . $filename;

        Storage::disk('local')->put($path, $qrCode);
    }
}
