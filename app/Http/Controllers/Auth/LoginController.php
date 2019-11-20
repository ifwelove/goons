<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendLoginResponse(Request $request)
    {
        $rememberTokenExpireMinutes = 10;

        $rememberTokenName = Auth::getRecallerName();

        Cookie::queue($rememberTokenName, Cookie::get($rememberTokenName), $rememberTokenExpireMinutes);

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

//    public function username()
//    {
//        return 'username';
//    }
//
//    protected function validateLogin(Request $request)
//    {
//        $request->validate([
//            $this->username() => 'required|string',
//            'password'        => 'required|string',
//            'captcha'         => 'required|captcha',
//        ], [
//            'captcha.required' => trans('validation.captcha.required'),
//            'captcha.captcha'  => trans('validation.captcha.error'),
//        ]);
//    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|exists:users,email,status,1',
            'password' => 'required|string',
        ]);
    }

//    protected function credentials(Request $request)
//    {
//        return array_merge($request->only($this->username(), 'password'), ['status' => 1]);
//    }
}
