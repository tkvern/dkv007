<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function profile(Request $request) {
        $user = $request->user();
        return view('user.info', ['user' => $user]);
    }

    public function update_profile(Request $request) {
        $this->profileValidator($request->input())->validate();
        $user = $request->user();
        $user->update($request->only(['phone_number', 'country' , 'region', 'contact_address']));
        return redirect()->back()->with(['flash_success_message' => '用户信息更新成功']);
    }

    public function password() {
        return view('user.password');
    }

    public function change_password(Request $request) {
        $this->passwordValidator($request)->validate();
        $user = $request->user();
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect()->back()->with(['flash_success_message' => '密码更新成功']);
    }

    private function profileValidator($data) {
        return Validator::make($data, [
           'phone_number' => ['required', 'regex:/^([0-9]|[-])+$/'],
            'country' => 'required',
            'region' => 'required',
            'contact_address' => 'required',
        ], [], [
            'phone_number' => '联系电话',
            'country' => '国家',
            'region' => '地区',
            'contact_address' => '联系地址',
        ]);
    }

    private function passwordValidator($request)  {
        $validator = Validator::make($request->input(), [
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        $validator->after(function($validator) use ($request){
            $user = $request->user();
            $data = $validator->getData();
            if (!password_verify($data['old_password'], $user->password)) {
                $validator->errors()->add('old_password', '原始密码不正确');
            }
        });
        return $validator;
    }
}
