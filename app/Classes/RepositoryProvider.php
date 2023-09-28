<?php

namespace App\Classes;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use App\Classes\Repository\Interfaces as IRepository;
use App\Classes\Repository as  Repository;


class RepositoryProvider extends ServiceProvider
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
        App::bind(IRepository\IUserRepository::class, Repository\UserRepository::class);
        App::bind(IRepository\IRoleRepository::class, Repository\RoleRepository::class);
        App::bind(IRepository\IPasswordResetToken::class, Repository\PasswordResetToken::class);
        App::bind(IRepository\ISettingFoodRepository::class, Repository\SettingFoodRepository::class);
        App::bind(IRepository\IFoodImagesRepository::class, Repository\FoodImagesRepository::class);
        App::bind(IRepository\IRestaurantSettingRepository::class, Repository\RestaurantSettingRepository::class);
    }
}
