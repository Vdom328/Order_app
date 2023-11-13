<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\LayoutController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TableSettingController;
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
        Route::get('/reset-password', [LoginController::class, 'resetPassword'])->name('admin.auth.resetPassword');

        Route::post('/reset-password-submit', [LoginController::class, 'submitResetPassword'])->name('admin.auth.submitResetPassword');
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

    // route orders
    Route::group(['prefix' => 'order', 'middleware' => "auth"], function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
        Route::get('/getOrder', [OrderController::class, 'getOrder'])->name('admin.order.getOrder');
        Route::get('/addOrderFood', [OrderController::class, 'addOrderFood'])->name('admin.order.addOrderFood');
        Route::get('/change-restaurant', [OrderController::class, 'changeRestaurant'])->name('admin.order.changeRestaurant');
        Route::post('/create-new-order', [OrderController::class, 'createNewOrder'])->name('admin.order.createNewOrder');
        Route::post('/edit-order', [OrderController::class, 'editOrder'])->name('admin.order.editOrder');
        Route::get('/delete-order/{id}', [OrderController::class, 'deleteOrder'])->name('admin.order.deleteOrder');
    });

    // route QR restaurant group
    Route::group(['prefix' => 'table', 'middleware' => "auth"], function () {
        Route::get('/', [TableSettingController::class, 'index'])->name('admin.listTable');
        Route::get('/create-qrCode', [TableSettingController::class, 'createQrCode'])->name('admin.table.createQrCode');
        Route::get('/show-qrCode', [TableSettingController::class, 'showQrCode'])->name('admin.table.showQrCode');
    });

    // route coupon
    Route::group(['prefix' => 'coupon', 'middleware' => "auth"], function () {
        Route::get('/', [CouponController::class, 'index'])->name('admin.coupons');
        Route::post('/submit-coupon', [CouponController::class, 'createCoupon'])->name('admin.coupons.create');
        Route::get('/delete-coupon/{id}', [CouponController::class, 'deleteCoupon'])->name('admin.coupons.delete');
        Route::get('/edit-coupon', [CouponController::class, 'editCoupon'])->name('admin.coupons.edit');
    });

    // route email address
    Route::group(['prefix' => 'email', 'middleware' => "auth"], function () {
        Route::get('/', [EmailController::class, 'index'])->name('admin.emails');
        Route::get('/edit/{id}', [EmailController::class, 'edit'])->name('admin.emails.edit');
        Route::post('/postEdit', [EmailController::class, 'postEdit'])->name('admin.emails.postEdit');
    });

});
