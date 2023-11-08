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
    public function index(Request $request)
    {
        $list_restaurant = $this->restaurantService->getRestaurants();
        if ($request->input('restaurant_id')) {
            $restaurant = $list_restaurant->where('id', $request->input('restaurant_id'))->first();
        }else{
            $restaurant = $list_restaurant->first();
        }
        return view('admin.table_setting.index', compact('list_restaurant','restaurant'));
    }

    /**
     * create qr code
     * composer require simplesoftwareio/simple-qrcode
     */
    public function createQrCode(Request $request)
    {
        $restaurant_id = $request->restaurant_id;
        $table_id = $request->table_id;
        $url = route('client.home') . '?restaurant_id=' . $restaurant_id . '&table_id=' . $table_id;
        $qrCode = QrCode::size(300)->generate($url);

        $filename = 'restaurant_id_'.$restaurant_id.'_table_id_'.$table_id.'.svg';
        $path = 'public/qr_codes/' . $filename;

        Storage::disk('local')->put($path, $qrCode);

        $table = $this->restaurantService->createTable($request->all(), $filename);
        $modal = view('admin.table_setting.partials._modal-show', compact('table'))->render();
        return response()->json($modal);
    }

    /**
     * show qr code blade
     */
    public function showQrCode(Request $request)
    {
        $table = $this->restaurantService->findTable($request->all());
        $modal = view('admin.table_setting.partials._modal-show', compact('table'))->render();
        return response()->json($modal);
    }
}
