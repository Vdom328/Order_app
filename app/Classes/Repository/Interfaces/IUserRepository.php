<?php

namespace App\Classes\Repository\Interfaces;


interface IUserRepository extends IBaseRepository
{
    public function listUsersAndRole();
    public function findUsersAndRole($id);
}
