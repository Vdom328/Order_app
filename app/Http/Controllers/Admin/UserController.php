<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\createUserRequest;
use App\Http\Requests\updateAccountRequest;

use App\Classes\Services\Interfaces\IUserService;
use App\Classes\Services\Interfaces\IRoleService;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    protected $IUserService;
    protected $IRoleService;

    public function __construct(
        IUserService $IUserService,
        IRoleService $IRoleService,

    ) {
        $this->IUserService = $IUserService;
        $this->IRoleService = $IRoleService;
    }

    /**
     * get list user blade
     * @return mixed
    */
    public function getlistUser()
    {
        $users = $this->IUserService->listUser();
        return view('admin.user.list', compact('users'));
    }

    /**
     * get Create user blade
     * @return mixed
    */
    public function getCreate()
    {
        $roles = $this->IRoleService->listRole();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * post Create user blade
     * @return mixed
    */
    public function postCreate(createUserRequest $request)
    {
        $createUser = $this->IUserService->createUser($request);
        if (!$createUser) {
            Session::flash('error', "An error occurred, please try again !");
            return view('admin.admin.detail', compact('admins'));
        }
        // Return a success
        Session::flash('success', "Add user successfully !");
        return redirect()->route('admin.user.list');
    }

    /**
     * get profile user by id blade
     * @param int $id
     * @return mixed
    */
    public function getProfile($id)
    {
        $roles = $this->IRoleService->listRole();
        $user = $this->IUserService->find($id);
        return view('admin.user.detail', compact('user','roles'));
    }

    /**
     * updateSocialLink user by id blade
     * @param int $id
     * @return mixed
    */
    public function updateSocialLink(request $request, $id)
    {
        $this->IUserService->findUpdateSocialLink($request, $id);
        return response()->json();
    }

    /**
     * updateAccount user by id blade
     * @param int $id
     * @return mixed
    */
    public function updateAccount(updateAccountRequest $request, $id)
    {

        $this->IUserService->updateAccount($request, $id);
        return response()->json();
    }

    /**
     * toggleStatus user by id blade
     * @param int $id
     * @return mixed
    */
    public function toggleStatus($id)
    {
        $user = $this->IUserService->find($id);
        $account_status = $user->account_status;
        $this->IUserService->toggleStatus($account_status,$id);
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * updateAvatar user by id blade
     * @param int $id
     * @return mixed
    */
    public function updateAvatar(request $request,$id)
    {
        $data= $request->all();
        $this->IUserService->updateAvatar($request,$id);
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * delete user by id blade
     * @param int $id
     * @return mixed
    */
    public function delete($id)
    {
        $this->IUserService->delete($id);
        return response()->json(['id' => $id]);
    }
}
