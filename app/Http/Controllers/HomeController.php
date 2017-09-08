<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    //    public function __construct()
    //    {
    //        $this->middleware('auth');
    //    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $orderStat = get_statistic_by_state(
            DB::table('task_orders')
                ->groupBy('state')
                ->select(DB::raw('count(out_trade_no) as count, state'))
                ->where('user_id', $user->id)
                ->get(),
            'state',
            'count'
        );
        $taskStat = get_statistic_by_state(
            DB::table('tasks')
                ->groupBy('handle_state')
                ->select('handle_state', DB::raw('count(id) as count'))
                ->where('user_id', $user->id)
                ->get(),
            'handle_state',
            'count'
        );

        return view('home', compact('user', 'orderStat', 'taskStat'));
    }

    public function jwt(Request $request)
    {
        //        $factory = JWTFactory::sub('user activate');
        //        $factory->setTTL(120);
        //        $payload = $factory->make();
        // $exp = $payload->getClaims()['exp'];
        // $exp->setValue(time() + 7200);
        //        $manager = app('tymon.jwt.manager');
        //        $token = $manager->encode($payload)->get();
        return response()->json(['token' => $request->user()->getActivateToken()]);
    }

    public function decode_jwt($token)
    {
        $manager = app('tymon.jwt.manager');
        $payload = $manager->decode(new Token($token))->get();
        return response()->json($payload);
    }
}
