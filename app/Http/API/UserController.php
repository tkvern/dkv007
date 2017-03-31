<?php
/**
 * Created by PhpStorm.
 * User: liujun
 * Date: 2017/4/1
 * Time: 上午12:43
 */

namespace App\Http\API;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request) {
        return $this->successJsonResponse(['user' => $request->user()]);
    }
}