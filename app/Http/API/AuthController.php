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
    function create(Request $request) {
        $this->validator($request->input())->validate();
        $user = User::where('username', $request->input('identity'))->orWhere('email', $request->input('identity'))->first();
        if ($user && password_verify($user->password, $request->input('password'))) {
            $token = JWTAuth::fromUser($user);
            return $this->successJsonResponse([
                'access_token' => $token,
                'user' => user,
            ]);
        } else {
            return $this->errorJsonResponse(400);
        }
    }

    function delete() {

    }

    protected function validator($data) {
        return Validator::make($data, [
            'identity' => 'required',
            'password' => 'required'
        ]);
    }
}