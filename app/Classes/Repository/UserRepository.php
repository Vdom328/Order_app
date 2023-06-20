<?php

namespace App\Classes\Repository;

use App\Notifications\Admin\RegistrationLinkNotification;
use Illuminate\Support\Facades\Notification;
use App\Classes\Repository\BaseRepository;
use App\Enums\ProductType;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use App\Mail\User\UpdateProfileMail;
use App\Mail\User\SendEmailConfimUser;
use App\Enums\UserStatus;

class UserRepository extends BaseRepository implements IUserRepository
{
    protected function broker()
    {
        return Password::broker('users'); //set password broker name according to guard which you have set in config/auth.php
    }
    public function model()
    {
        return User::class;
    }

    public function listUsersAndRole()
    {
        return User::join('roles', 'users.role_id', '=', 'roles.id')
                ->select('users.*', 'roles.name as role_name')
                ->get();
    }
    public function findUsersAndRole($id)
    {
        return User::join('roles', 'users.role_id', '=', 'roles.id')
                ->select('users.*', 'roles.name as role_name')
                ->find($id);
    }
}
