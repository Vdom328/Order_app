<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\Services\Interfaces\IRoleService;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{

    protected $IRoleService;
    public function __construct(
        IRoleService $IRoleService,

    ) {
        $this->IRoleService = $IRoleService;
    }

    /**
     * get list role list data
     */
    public function getlistRole()
    {
        $roles = $this->IRoleService->listRole();
        return view('admin.role.list', compact('roles'));
    }

    /**
     * update data by $request
     * @param mixed $request
     * @return void
     */
    public function postCreate(request $request)
    {
        if($request->name == ''){
            Session::flash('error', "An error occurred, please try again !");
            return redirect()->route('admin.role.list');
        }
        $createRole = $this->IRoleService->createRole($request);
        if (!$createRole) {
            Session::flash('error', "An error occurred, please try again !");
            return redirect()->route('admin.role.list');
        }
        // Return a success
        Session::flash('success', "Add role successfully !");
        return redirect()->route('admin.role.list');
    }

    /**
     * get blade edit role by id
     * @param int  $id
     * @return
     */
    public function getEditRole($id)
    {
        $role = $this->IRoleService->find($id);
        return response()->json( $role);
    }

    /**
     * update data by id
     */
    public function postEditRole(Request $request ,$id)
    {
        $role = $this->IRoleService->postEditRole($request, $id);
        if (!$role) {
            Session::flash('error', "An error occurred, please try again !");
            return redirect()->route('admin.role.list');
        }
        // Return a success
        Session::flash('success', "Update role successfully !");
        return redirect()->route('admin.role.list');
    }

    /**
     * delete tole by id
     * @param int $id
     */
    public function deleteRole($id)
    {
        $role = $this->IRoleService->delete($id);
        if (!$role) {
            Session::flash('error', "An error occurred, please try again !");
            return redirect()->route('admin.role.list');
        }
        // Return a success
        Session::flash('success', "Delete role successfully !");
        return redirect()->route('admin.role.list');
    }
}
