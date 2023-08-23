<?php

namespace App\Classes\Repository;


use App\Classes\Repository\Interfaces\IUserRepository;;
use App\Models\User;

class UserRepository extends BaseRepository implements IUserRepository
{
    // protected function broker()
    // {
    //     return Password::broker('users'); //set password broker name according to guard which you have set in config/auth.php
    // }
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
