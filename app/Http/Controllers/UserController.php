<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function profile(Request $request) {
        $user = $request->user();
        return view('user.info', ['user' => $user]);
    }

    public function update_profile() {

    }

    public function password() {
        return view('user.password');
    }

    public function change_password() {

    }
}
