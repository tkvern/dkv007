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

    public function jwt(Request $request) {
//        $factory = JWTFactory::sub('user activate');
//        $factory->setTTL(120);
//        $payload = $factory->make();
        // $exp = $payload->getClaims()['exp'];
        // $exp->setValue(time() + 7200);
//        $manager = app('tymon.jwt.manager');
//        $token = $manager->encode($payload)->get();
        return response()->json(['token' => $request->user()->getActivateToken()]);
    }

    public function decode_jwt($token) {
        $manager = app('tymon.jwt.manager');
        $payload = $manager->decode(new Token($token))->get();
        return response()->json($payload);
    }
}
