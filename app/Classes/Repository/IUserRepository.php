<?php

namespace App\Classes\Repository;

use App\Classes\Repository\IBaseRepository;

interface IUserRepository extends IBaseRepository
{
    public function listUsersAndRole();
    public function findUsersAndRole($id);
}
