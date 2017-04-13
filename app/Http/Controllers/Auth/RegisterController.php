<?php

namespace App\Http\Controllers\Auth;

use App\Mail\UserActivate;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Mail::to($user->email)->send(new UserActivate($user));

        flash('确认邮件已发送到您的邮箱, 请前往激活', 'success');
        return redirect(route('user.activate_email', ['email' => $user->email]));
//        $this->guard()->login($user);
//
//        return $this->registered($request, $user)
//              ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'account_type' => 'required',
            'name' => 'required|max:255',
            'phone_number' => 'required',
            'country' => 'required',
            'region' => 'required|max:100',
            'address' => 'required',
            'password' => 'required|min:6|confirmed',
            'captcha' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'account_type' => $data['account_type'],
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'country' => $data['country'],
            'region' => $data['region'],
            'contact_address' => $data['address'],
            'password' => bcrypt($data['password']),
            'captcha' => $data['captcha'],
        ]);
    }
}
