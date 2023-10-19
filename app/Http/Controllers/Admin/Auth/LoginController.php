<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Classes\Services\Interfaces\IUserService;
use App\Classes\Services\Interfaces\IRoleService;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\Enum\StatusUserEnum;
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
            $user = Auth::user();
            if ($user->account_status == StatusUserEnum::Inactive) {
                Auth::logout();
                Session::flash('error', "Your account is suspended.");
                return redirect()->back();
            }
            $request->session()->regenerate();

            Session::flash('success', "Log in successfully !");
            return redirect()->route('admin.home');
        }
        Session::flash('error', "The provided credentials do not match our records.");
        return redirect()->back();
    }

    public function getLogout(): RedirectResponse
    {
        Auth::logout();
        Session::flash('success', "You have been logged out successfully.");
        return redirect()->route('admin.auth.getLogin');
    }

    public function getForgot()
    {
        return view('admin.auth.aut-password');
    }

    public function postForgot(Request $request)
    {
        $this->IUserService->postForgotByEmail($request->email);
        dd($request->all());
    }
}
