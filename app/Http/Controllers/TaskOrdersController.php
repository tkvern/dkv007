<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskOrdersController extends Controller
{
    private  $user;

    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    //
    public function index() {
        $orders = $this->user->task_orders()->paginate(20);
        return view('tasks.order', ['orders' => $orders]);
    }

    public function show($order_id) {
        $order = $this->user->task_orders()->findOrFail($order_id);
        $order->load('tasks');
        return view();
    }
}
