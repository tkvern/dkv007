<?php
/**
 * Created by PhpStorm.
 * User: liujun
 * Date: 2017/4/4
 * Time: 下午8:14
 */

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
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
            flash('无效的激活链接，请重新获取激活邮件', 'danger');
            return redirect(route('user.activate_email'));
        }
        $email = $payload['sub'];
        $user = User::where('email', $email)->firstOrFail();
        if (!$user->isActivated()) {
            $user->activated_at = Carbon::now();
            $user->save();
            flash('用户激活成功, 请登录', 'success');
            return redirect(route('login'));
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
        } else if ($user->isActivated()) {
            return redirect()->back()->withErrors(['email' => '该邮箱已经被激活了']);
        }
        Mail::to($user->email)->send(new UserActivate($user));
        flash('激活链接已发送到你的邮箱', 'success');
        return redirect(route('user.activate_email'));
    }

    private function validator($data) {
        return Validator::make($data, ['email' => 'required|email']);
    }
}