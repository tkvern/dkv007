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

class ActivateController extends Controller
{
    public function show() {
        return view('auth.activate');
    }

    public function activate($token) {
        echo $token;
    }

    /**
     * send use activate email
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