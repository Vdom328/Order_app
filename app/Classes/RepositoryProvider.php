<?php

namespace App\Classes;

use App\Classes\Repository\IUserRepository;
use App\Classes\Repository\UserRepository;
use App\Classes\Repository\IRoleRepository;
use App\Classes\Repository\RoleRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;


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
        App::bind(IUserRepository::class, UserRepository::class);
        App::bind(IRoleRepository::class, RoleRepository::class);
    }
}
