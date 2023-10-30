<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::prefix('admin')->group(function () {
//     require __DIR__.'/admin.php';
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'getLogin'])->name('client.getLogin');


Route::get('/home', [HomeController::class, 'index'])->name('client.home');

Route::get('/table', [HomeController::class, 'getTable'])->name('client.getTable');

Route::get('/detail-food/{id}', [HomeController::class, 'getDetailFood'])->name('client.getDetailFood');
Route::get('/check-time-add-cart', [HomeController::class, 'checkTimeAddCart'])->name('client.checkTimeAddCart');

Route::get('/list-cart', [HomeController::class, 'getListCart'])->name('client.getListCart');
Route::get('/order-now', [HomeController::class, 'getOrderNow'])->name('client.getOrderNow');
