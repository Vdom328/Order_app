<?php

namespace App\Classes\Services;

use App\Classes\Repository\IRoleRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserStatus;
use Carbon\Carbon;

class RoleService extends BaseService implements IRoleService
{
    protected $roleRepository;

    public function __construct(IRoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }


    public function listRole()
    {
        return $this->roleRepository->all();
    }
    /**
     * create account user
     * @param  mixed $data
     * @return mixed
     */
    public function createRole($request)
    {
        $attribute = [
                    'name' => $request['name'],
                ];
        return $this->roleRepository->create($attribute);
    }
    public function find($id)
    {
        return $this->roleRepository->find($id);
    }
    public function postEditRole($request, $id)
    {
        $attribute = [
            'name' => $request['name'],
        ];
        return $this->roleRepository->update($id, $attribute);
    }
    public function delete($id)
    {
        return $this->roleRepository->delete($id);
    }

}
