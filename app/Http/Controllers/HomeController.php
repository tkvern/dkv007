<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function jwt() {
        $payload = JWTFactory::sub('user activate')->exp(time() + 3600)->make();
        $manager = app('tymon.jwt.manager');
        $token = $manager->encode($payload)->get();
        return response()->json(['token' => $token]);
    }

    public function decode_jwt($token) {
        $manager = app('tymon.jwt.manager');
        $payload = $manager->decode(new Token($token))->get();
        return response()->json($payload);
    }
}
