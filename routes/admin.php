<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\RestaurantFoodController;

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.home')->middleware('auth');
    // route authorization
    Route::group(['prefix' => 'auth'], function () {
        Route::get('/login', [LoginController::class, 'getLogin'])->name('admin.auth.getLogin');
        Route::match(['get', 'post'], '/postLogin', [LoginController::class, 'postLogin'])->name('admin.auth.postLogin');
        Route::get('/logout', [LoginController::class, 'getLogout'])->name('admin.auth.getLogout');
        // forgot password
        Route::get('/forgot', [LoginController::class, 'getForgot'])->name('admin.auth.getForgot');
        Route::post('/postForgot', [LoginController::class, 'postForgot'])->name('admin.auth.postForgot');


    });
    // route user profile
    Route::group(['prefix' => 'user', 'middleware' => "auth"], function () {
        Route::get('/list', [UserController::class, 'getlistUser'])->name('admin.user.list');
        Route::post('/postCreate', [UserController::class, 'postCreate'])->name('admin.user.postCreate');
        Route::get('/getCreate', [UserController::class, 'getCreate'])->name('admin.user.getCreate');
        // profile routes
        Route::get('/profile/{id}', [UserController::class, 'getProfile'])->name('admin.user.getProfile');
        Route::post('/updateSocialLink/{id}', [UserController::class, 'updateSocialLink'])->name('admin.user.updateSocialLink');
        Route::post('/updateAccount/{id}', [UserController::class, 'updateAccount'])->name('admin.user.updateAccount');
        Route::post('/toggle-account-status/{id}', [UserController::class, 'toggleStatus'])->name('admin.user.toggleStatus');
        Route::post('/updateAvatar/{id}', [UserController::class, 'updateAvatar'])->name('admin.user.updateAvatar');
        // delete account
        Route::post('/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
    });
    // route role change
    Route::group(['prefix' => 'role', 'middleware' => "auth"], function () {
        Route::get('/list', [RoleController::class, 'getlistRole'])->name('admin.role.list');
        Route::post('/postCreate', [RoleController::class, 'postCreate'])->name('admin.role.postCreate');
        Route::get('/editRole/{id}', [RoleController::class, 'getEditRole'])->name('admin.role.getEditRole');
        Route::post('/postEditRole/{id}', [RoleController::class, 'postEditRole'])->name('admin.role.postEditRole');
        Route::get('/deleteRole/{id}', [RoleController::class, 'deleteRole'])->name('admin.role.deleteRole');
    });
    // route settings food
    Route::group(['prefix' => 'setting_food', 'middleware' => "auth"], function () {
        Route::get('/', [FoodController::class, 'index'])->name('admin.setting_food.index');
        Route::get('/create', [FoodController::class, 'getCreate'])->name('admin.setting_food.getCreate');
        Route::POST('/postCreate', [FoodController::class, 'postCreate'])->name('admin.setting_food.postCreate');
        Route::get('/ajaxCheckbox', [FoodController::class, 'ajaxCheckbox'])->name('admin.setting_food.ajaxCheckbox');
        Route::get('/delete/{id}', [FoodController::class, 'delete'])->name('admin.setting_food.delete');
        Route::get('/edit/{id}', [FoodController::class, 'edit'])->name('admin.setting_food.edit');
        Route::post('/edit/{id}', [FoodController::class, 'postEdit'])->name('admin.setting_food.postEdit');
    });
    // route restaurant food
    Route::group(['prefix' => 'restaurant_food', 'middleware' => "auth"], function () {
        Route::get('/', [RestaurantFoodController::class, 'index'])->name('admin.restaurant_food.index');
        Route::get('/getMeals', [RestaurantFoodController::class, 'getMeals'])->name('admin.restaurant_food.getMeals');
        Route::get('/getCheckbox', [RestaurantFoodController::class, 'getCheckbox'])->name('admin.restaurant_food.getCheckbox');
        Route::post('/post-food-restaurant', [RestaurantFoodController::class, 'postFoodRestaurant'])->name('admin.restaurant_food.postFoodRestaurant');
    });
    // route restaurant setting
    Route::group(['prefix' => 'restaurant', 'middleware' => "auth"], function () {
        Route::get('/create', [RestaurantController::class, 'restaurant_setting'])->name('admin.restaurant.restaurant_setting');
        Route::post('/postUpdate', [RestaurantController::class, 'postUpdate'])->name('admin.restaurant.postUpdate');
        Route::get('/', [RestaurantController::class, 'index'])->name('admin.restaurant.index');
        Route::get('/update/{id}', [RestaurantController::class, 'update'])->name('admin.restaurant.update');
        Route::post('/delete/{id}', [RestaurantController::class, 'delete'])->name('admin.restaurant.delete');
    });
});
