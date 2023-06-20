<?php

namespace App\Classes\Services;

interface IUserService
{
    public function listUser();
    public function createUser($data);
    public function find($id);
    public function findUpdateSocialLink($request, $id);
}
