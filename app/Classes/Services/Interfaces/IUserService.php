<?php

namespace App\Classes\Services\Interfaces;

interface IUserService
{
    public function listUser();
    public function createUser($data);
    public function find($id);
    public function findUpdateSocialLink($request, $id);
    public function updateAccount($request, $id);
    public function toggleStatus($account_status, $id);
    public function updateAvatar($request, $id);
    public function delete($id);
    public function postForgotByEmail($email);

    /**
     * post create user client
     * @param array $data
     */
    public function registerUserClient($data);

    /**
     * get email by token
     */
    public function getEmailByToken($token);

    /**
     * update password by email
     * @param array $data
     */
    public function updatePassword($data);
}
