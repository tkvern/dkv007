<?php
/**
 * Created by PhpStorm.
 * User: liujun
 * Date: 2017/4/4
 * Time: 下午8:14
 */

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\UserActivate;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\Exception;
use Tymon\JWTAuth\Token;

class ActivateController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function show() {
        return view('auth.activate');
    }

    public function activate($token) {
        $manager = app('tymon.jwt.manager');
        try {
            $payload = $manager->decode(new Token($token))->get();
        } catch (Exception $e) {
            return redirect(route('user.activate_email'))->with(['flash_message' => '用户激活失败，请重新获取激活邮件']);
        }
        $email = $payload['sub'];
        $user = User::where('email', $email)->first();
        if ($user && !$user->isActivated()) {
            $user->update('activated_at', time());
            return redirect(route('login'))->with(['flash_message' => '用户激活成功']);
        }
        return redirect(route('login'))->withInput(['account' => $user->email]);
    }

    /**
     * send use activate email
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function sendActivateEmail(Request $request) {
        $this->validator($request->input())->validate();
        $user = User::where('email', $request->input('email'))->first();
        if(!$user) {
            return redirect()->back()->withErrors(['email' => '邮箱地址不存在']);
        }
        Mail::to($user->email)->send(new UserActivate($user));
        return redirect(route('user.activate_email'))->with(['flash_message' => '激活链接已发送到你的邮箱']);
    }

    private function validator($data) {
        return Validator::make($data, ['email' => 'required|email']);
    }
}