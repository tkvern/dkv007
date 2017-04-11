<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskOrdersController extends Controller
{
    //
    public function index(Request $request) {
        $user = $request->user();
        $orders = $user->taskOrders()->paginate(10);
        return view('orders.index', ['orders' => $orders]);
    }

    public function show(Request $request, $order_id) {
        $user = $request->user();
        $order = $user->taskOrders()->findOrFail($order_id);
        $order->load('tasks');
        return view('orders.show', ['order' => $order]);
    }
}
