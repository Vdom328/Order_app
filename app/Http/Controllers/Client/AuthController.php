<?php

namespace App\Http\Controllers\Client;

use App\Classes\Enum\StatusUserEnum;
use App\Classes\Services\Interfaces\IOrderService;
use App\Classes\Services\Interfaces\IUserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $userService, $orderService;

    public function __construct(
        IUserService $userService,
        IOrderService $orderService
    ) {
        $this->userService = $userService;
        $this->orderService = $orderService;
    }

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

    /**
     * post register user
     */
    public function postRegister(RegisterRequest $request) {
        $register = $this->userService->registerUserClient($request->all());
        if ($register == false) {
            return response()->json(['error' => "An error occurred."]);
        }
        return response()->json(['success' => "register successfully !"]);
    }

    /**
     * get log out user
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('client.getLogin');
    }
}
