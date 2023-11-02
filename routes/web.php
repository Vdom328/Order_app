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

//auth routes
Route::get('/login', [AuthController::class, 'getLogin'])->name('client.getLogin');
Route::post('/login', [AuthController::class, 'postLogin'])->name('client.postLogin');
Route::post('/register', [AuthController::class, 'postRegister'])->name('client.postRegister');
Route::get('/logout', [AuthController::class, 'getLogout'])->name('client.getLogout');

//route home
Route::get('/home', [HomeController::class, 'index'])->name('client.home');

// route table
Route::get('/table', [HomeController::class, 'getTable'])->name('client.getTable');


// route detail food
Route::get('/detail-food/{id}', [HomeController::class, 'getDetailFood'])->name('client.getDetailFood');
Route::get('/check-time-add-cart', [HomeController::class, 'checkTimeAddCart'])->name('client.checkTimeAddCart');

// route list cart and order 
Route::get('/list-cart', [HomeController::class, 'getListCart'])->name('client.getListCart');
Route::get('/order-now', [HomeController::class, 'getOrderNow'])->name('client.getOrderNow');
Route::post('/order-success', [HomeController::class, 'getOrderSuccess'])->name('client.getOrderSuccess');
