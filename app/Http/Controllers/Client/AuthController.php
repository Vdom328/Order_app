<?php

namespace App\Http\Controllers\Client;

use App\Classes\Enum\StatusUserEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * get blade login
     */
    public function getLogin()
    {
        return view('client.auth.signIn-signUp');
    }

    /**
     * post login
     */
    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->account_status == StatusUserEnum::Inactive) {
                Auth::logout();
                return response()->json(['error' => "Your account is suspended."]);
            }
            $request->session()->regenerate();

            Session::flash('success', "Log in successfully !");
            return response()->json(['success' => "Log in successfully !"]);
        }
        return response()->json(['error' => "The provided credentials do not match our records."]);
    }
}
