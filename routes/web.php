<?php

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

Route::get('/home', function () {
    return view('client.home');
});
// Route::get('/home', function () {
//     return view('client.test.master');
// });
