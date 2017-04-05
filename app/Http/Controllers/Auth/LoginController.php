<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * rewrite username
     */
    public function username() {
        return 'account';
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ]);
    }

    protected function attemptLogin(Request $request) {
        $user = User::where('username', $request->input($this->username()))
                    ->orWhere('email', $request->input($this->username()))
                    ->first();
        if ($user && password_verify($request->input('password'), $user->password)) {
            $user->update(['login_ip' => $request->getClientIp(), 'login_at' => time() ]);
            $this->guard()->login($user, $request->has('remember'));
        }
        return $user;
    }
}
