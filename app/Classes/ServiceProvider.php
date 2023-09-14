<?php

namespace App\Classes;

use Illuminate\Support\Facades\App;
use App\Classes\Services as Service;
use App\Classes\Services\Interfaces as IService;
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
        App::bind(IService\IUserService::class, Service\UserService::class);
        App::bind(IService\IRoleService::class, Service\RoleService::class);
        App::bind(IService\ISettingFoodService::class, Service\SettingFoodService::class);
        App::bind(IService\IRestaurantService::class, Service\RestaurantService::class);
    }
}
