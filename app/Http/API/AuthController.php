<?php
/**
 * Created by PhpStorm.
 * User: liujun
 * Date: 2017/3/31
 * Time: 下午4:26
 */

namespace App\Http\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function create(Request $request) {
        $this->validator($request->input())->validate();
        $user = User::where('username', $request->input('account'))->orWhere('email', $request->input('account'))->first();
        if ($user && password_verify($request->input('password'), $user->password)) {
            if (!$user->isActivated()) {
                return $this->errorJsonResponse(400, 'account is not activated.');
            }
            $token = JWTAuth::fromUser($user);
            return $this->successJsonResponse([
                'access_token' => $token,
                'user' => $user,
            ]);
        } else {
            return $this->errorJsonResponse(400, 'account or password is not correct.');
        }
    }

    public function delete() {

    }

    protected function validator($data) {
        return Validator::make($data, [
            'account' => 'required',
            'password' => 'required'
        ]);
    }
}