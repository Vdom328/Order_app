<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IPasswordResetToken;
use App\Classes\Repository\Interfaces\IUserRepository;
use App\Classes\Services\Interfaces\IUserService;
use Illuminate\Support\Facades\Hash;
use App\Classes\Enum\StatusUserEnum;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserService extends BaseService implements IUserService
{
    protected $userRepository, $passwordResetToken;

    public function __construct(
        IUserRepository $userRepository,
        IPasswordResetToken $passwordResetToken
    )
    {
        $this->userRepository = $userRepository;
        $this->passwordResetToken = $passwordResetToken;
    }

    /**
     * get list user
     * @return mixed
     */
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
        $attribute = [
            'account_status' => $data['account_status'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
            'telephone' => $data['telephone'],
            'gender' => $data['gender'],
            'facebook' => $data['facebook'],
            'twitter' => $data['twitter'],
            'linkedin' => $data['linkedin'],
            'role_id' => $data['role_id'],
            'avatar' => null,
        ];

        if (!Storage::exists('public/avatarUser')) {
            // Tạo mới thư mục avatarUser
            Storage::makeDirectory('public/avatarUser');
        }

        if ($data && $data->hasFile('avatar')) {
            $imageName = uniqid() . '.' . $data->file('avatar')->extension();
            $data->file('avatar')->storeAs('public/avatarUser/', $imageName);
            $attribute['avatar'] = $imageName;
        }

        return $this->userRepository->create($attribute);
    }

    /**
     * find user by id
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userRepository->findUsersAndRole($id);
    }

    /**
     * findUpdateSocialLink user by id
     * @param int $id
     * @return mixed
     */
    public function findUpdateSocialLink($request, $id)
    {
        $attribute = [
            'facebook' => $request['facebook'],
            'twitter' => $request['twitter'],
            'linkedin' => $request['linkedin'],
        ];
        return $this->userRepository->update($id, $attribute);
    }

    /**
     * updateAccount user by id
     * @param int $id
     * @return mixed
     */
    public function updateAccount($request, $id)
    {
        $attribute = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'address' => $request['address'],
            'telephone' => $request['telephone'],
            'gender' => $request['gender'],
            'role_id' => $request['role_id'],
        ];
        return $this->userRepository->update($id, $attribute);
    }

    /**
     * toggleStatus user by id
     * @param int $id
     * @return mixed
     */
    public function toggleStatus($account_status, $id)
    {
        if ($account_status == StatusUserEnum::Active) {
            $attribute = [
                'account_status' => StatusUserEnum::Inactive,
            ];
        } else {
            $attribute = [
                'account_status' => StatusUserEnum::Active,
            ];
        }
        return $this->userRepository->update($id, $attribute);
    }

    /**
     * updateAvatar user by id
     * @param int $id
     * @return mixed
     */
    public function updateAvatar($request, $id)
    {
        if (!Storage::exists('public/avatarUser')) {
            // Tạo mới thư mục avatarUser
            Storage::makeDirectory('public/avatarUser');
        }

        // Kiểm tra xem request có chứa file ảnh không
        if ($request->hasFile('avatar')) {
            // Lấy thông tin user hiện tại và xóa ảnh cũ (nếu có)
            $user = $this->userRepository->find($id);
            if (!empty($user->avatar)) {
                Storage::delete('public/avatarUser/' . $user->avatar);
            }
            // Upload ảnh mới và lưu vào database
            $imageName = uniqid() . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->storeAs('public/avatarUser/', $imageName);

            $attribute['avatar'] = $imageName;
            return $this->userRepository->update($id, $attribute);
        }
    }

    /**
     * delete user by id
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    /**
     * postForgotByEmail user by id
     * @param int $id
     * @return mixed
     */
    public function postForgotByEmail($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            $token = Str::random(60);
            $attr = [
                'email' => $email,
                'token' => $token,
            ];
            $password_token = $this->passwordResetToken->create($attr);
            dd($password_token);
            Mail::to($user->email)->send(new ResetPassword($user));
            return true;
        }
        return false;
    }
}
