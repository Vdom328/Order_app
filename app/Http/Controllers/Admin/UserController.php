<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\createUserRequest;
use App\Http\Requests\updateAccountRequest;

use App\Classes\Services\IUserService;
use App\Classes\Services\IRoleService;
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

    public function getlistUser()
    {
        $users = $this->IUserService->listUser();
        return view('admin.user.list', compact('users'));
    }
    public function getCreate()
    {
        $roles = $this->IRoleService->listRole();
        return view('admin.user.create', compact('roles'));
    }
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
    public function getProfile($id)
    {
        $roles = $this->IRoleService->listRole();
        $user = $this->IUserService->find($id);
        return view('admin.user.detail', compact('user','roles'));
    }
    public function updateSocialLink(request $request, $id)
    {
        $this->IUserService->findUpdateSocialLink($request, $id);
        return response()->json();
    }
    public function updateAccount(updateAccountRequest $request, $id)
    {
        $validator = $request->validated();
        if($validator->fails()){
            $errors = $validator->errors(); // Get errors
            $errorMsgs = json_decode($errors); // Convert errors to JSON
            return response()->json(['errors' => $errorMsgs], 422); // Return errors in JSON format
        }
        $this->IUserService->updateAccount($request, $id);
        return response()->json();
    }
    public function toggleStatus($id)
    {
        $user = $this->IUserService->find($id);
        $account_status = $user->account_status;
        $this->IUserService->toggleStatus($account_status,$id);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function updateAvatar(request $request,$id)
    {
        $data= $request->all();
        $this->IUserService->updateAvatar($request,$id);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function delete($id)
    {
        $this->IUserService->delete($id);
        return response()->json(['id' => $id]);
    }
}
