<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Classes\Services\IUserService;
use App\Classes\Services\IRoleService;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
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

    public function getLogin()
    {
        return view('admin.auth.aut-signin');
    }

    public function postLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Session::flash('success', "Log in successfully !");
            return redirect()->route('admin.home');
        }

        Session::flash('error', "The provided credentials do not match our records.");
        return redirect()->back();
    }
}
