<?php

namespace App\Classes\Services;

interface IRoleService
{
    public function listRole();
    public function createRole($request);
    public function find($id);
    public function postEditRole($request, $id);
    public function delete($id);
}
