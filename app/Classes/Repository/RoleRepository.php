<?php

namespace App\Classes\Repository;

use App\Classes\Repository\BaseRepository;
use App\Models\Role;

class RoleRepository extends BaseRepository implements IRoleRepository
{

    public function model()
    {
        return Role::class;
    }

   
}
