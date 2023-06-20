<?php

namespace App\Classes\Services;

use App\Classes\Repository\IUserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService extends BaseService implements IUserService
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function listUser()
    {
        return $this->userRepository->listUsersAndRole();
    }
    /**
     * create account user
     * @param  mixed $data
     * @return mixed
     */
    public function createUser($data)
    {
        $imageName = uniqid().'.'.$data->file('avatar')->extension();
        $data->file('avatar')->storeAs('public', $imageName);
        $attribute = [
            'account_status' => $data['account_status'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'password' => Hash::make('password'),
            'telephone' => $data['telephone'],
            'gender' => $data['gender'],
            'facebook' => $data['facebook'],
            'twitter' => $data['twitter'],
            'linkedin' => $data['linkedin'],
            'role_id'=>$data['role_id'],
            'avatar' => $imageName,
        ];
        return $this->userRepository->create($attribute);
    }
    public function find($id)
    {
        return $this->userRepository->findUsersAndRole($id);
    }
    public function findUpdateSocialLink($request, $id)
    {
        $attribute = [
            'facebook' => $request['facebook'],
            'twitter' => $request['twitter'],
            'linkedin' => $request['linkedin'],
        ];
        return $this->userRepository->update($id, $attribute);
    }
}
