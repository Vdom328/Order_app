<?php

namespace App\Classes;

use App\Classes\Services\IUserService;
use App\Classes\Services\UserService;
use App\Classes\Services\RoleService;
use App\Classes\Services\IRoleService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider as LServiceProvider;


class ServiceProvider extends LServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(IUserService::class, UserService::class);
        App::bind(IRoleService::class, RoleService::class);
    }
}
