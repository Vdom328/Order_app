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

    /**
     * find user and role
     */
    public function listUsersAndRole()
    {
        return User::join('roles', 'users.role_id', '=', 'roles.id')
                ->select('users.*', 'roles.name as role_name')
                ->get();
    }

    /**
     * find user and by id
     * @param int $id
     */
    public function findUsersAndRole($id)
    {
        return User::join('roles', 'users.role_id', '=', 'roles.id')
                ->select('users.*', 'roles.name as role_name')
                ->find($id);
    }

    /**
     * @inheritDoc
     */
    public function findByDate($date)
    {
        $query = $this->model;
        return $query->whereDate('created_at', $date)->get();
    }
}
