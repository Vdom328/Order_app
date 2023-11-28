<?php

namespace App\Classes\Repository\Interfaces;


interface IUserRepository extends IBaseRepository
{
    public function listUsersAndRole();
    public function findUsersAndRole($id);

    /**
     * find user by date
     */
    public function findByDate($date);
}
