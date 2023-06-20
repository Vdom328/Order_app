<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\createUserRequest;
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
        $user = $this->IUserService->find($id);
        return view('admin.user.detail', compact('user'));
    }
    public function updateSocialLink(request $request, $id)
    {
        $updateSocialLink = $this->IUserService->findUpdateSocialLink($request, $id);
        if (!$updateSocialLink) {
            Session::flash('error', "An error occurred, please try again !");
            return view('admin.admin.detail', compact('admins'));
        }
        // Return a success
        Session::flash('success', "Update Social Link successfully !");
        return redirect()->route('admin.user.getProfile',$id);
        // return response()->json($response, 200);
    }
}
