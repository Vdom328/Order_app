<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;




Route::get('/', [HomeController::class, 'index'])->name('admin.home');
Route::group(['prefix' => 'user'], function () {
    Route::get('/list', [UserController::class, 'getlistUser'])->name('admin.user.list');
    Route::post('/postCreate', [UserController::class, 'postCreate'])->name('admin.user.postCreate');
    Route::get('/getCreate', [UserController::class, 'getCreate'])->name('admin.user.getCreate');
    // profile routes
    Route::get('/profile/{id}', [UserController::class, 'getProfile'])->name('admin.user.getProfile');
    Route::post('/updateSocialLink/{id}', [UserController::class, 'updateSocialLink'])->name('admin.user.updateSocialLink');
});
Route::group(['prefix' => 'role'], function () {
    Route::get('/list', [RoleController::class, 'getlistRole'])->name('admin.role.list');
    Route::post('/postCreate', [RoleController::class, 'postCreate'])->name('admin.role.postCreate');
    Route::get('/editRole/{id}', [RoleController::class, 'getEditRole'])->name('admin.role.getEditRole');
    Route::post('/postEditRole/{id}', [RoleController::class, 'postEditRole'])->name('admin.role.postEditRole');
    Route::get('/deleteRole/{id}', [RoleController::class, 'deleteRole'])->name('admin.role.deleteRole');
});
