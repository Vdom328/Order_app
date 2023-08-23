<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProjectController;

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.home')->middleware('auth');

    Route::group(['prefix' => 'auth'], function () {
        Route::get('/login', [LoginController::class, 'getLogin'])->name('admin.auth.getLogin');
        Route::match(['get', 'post'], '/postLogin', [LoginController::class, 'postLogin'])->name('admin.auth.postLogin');
        Route::get('/logout', [LoginController::class, 'getLogout'])->name('admin.auth.getLogout');
        // forgot password
        Route::get('/forgot', [LoginController::class, 'getForgot'])->name('admin.auth.getForgot');
        Route::post('/postForgot', [LoginController::class, 'postForgot'])->name('admin.auth.postForgot');


    });

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

    Route::group(['prefix' => 'role', 'middleware' => "auth"], function () {
        Route::get('/list', [RoleController::class, 'getlistRole'])->name('admin.role.list');
        Route::post('/postCreate', [RoleController::class, 'postCreate'])->name('admin.role.postCreate');
        Route::get('/editRole/{id}', [RoleController::class, 'getEditRole'])->name('admin.role.getEditRole');
        Route::post('/postEditRole/{id}', [RoleController::class, 'postEditRole'])->name('admin.role.postEditRole');
        Route::get('/deleteRole/{id}', [RoleController::class, 'deleteRole'])->name('admin.role.deleteRole');
    });
    Route::group(['prefix' => 'project', 'middleware' => "auth"], function () {
        Route::get('/', [ProjectController::class, 'index'])->name('admin.project.index');
    });
});
