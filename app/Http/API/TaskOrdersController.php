<?php
/**
 * Created by PhpStorm.
 * User: liujun
 * Date: 2017/4/1
 * Time: 上午10:09
 */

namespace App\Http\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\TaskOrder;
use App\Models\Task;

class TaskOrdersController extends Controller
{
    private $order;

    public function index(Request $request) {
        $user = $request->user();
        $orders = $user->taskOrders()->with('tasks')->paginate(10);
        return $this->paginateJsonResponse($orders);
    }

    public function show(Request $request, $order_sn) {
        $user = $request->user();
        $order = $user->taskOrders()->where('out_trade_no', $order_sn)->first();
        $order->load('tasks');
        return $this->successJsonResponse(['order' => $order]);
    }

    public function create(Request $request) {
        $this->validator($request->input())->validate();
        DB::transaction(function () use($request) {
            $user = $request->user();
            $order = TaskOrder::make($user, $request->input('deliver_type'), 0, 0);
            $order->trade_name = 'trade_'.date('ymdHis');
            $order->pay_type = '';
            $order->pay_state = 'pay_free';
            $order->save();
            $tasks = $request->input('tasks');
            foreach($tasks as $task) {
                $newTask = new Task([
                    'name' => $task['name'],
                    'local_dir' => $task['local_dir'],
                    'handle_params' => $task['handle_params'],
                    'deliver_type' => $request->input('deliver_type'),
                ]);
                $newTask->price = 0;
                $newTask->real_price = 0;
                $newTask->user_id = $user->id;
                $newTask->user_name = $user->name;
                $newTask->pay_state = $order->pay_state;
                $newTask->handle_state = 'resource_waiting';
                $newTask->order_no = $order->out_trade_no;
                $newTask->save();
                $this->order = $order;
            }
        });
        $ret = ['order' => $this->order];
        return $this->successJsonResponse($ret);
    }

    private function validator($data) {
        return Validator::make($data, [
            'deliver_type' => [
                'required',
                Rule::in(['network', 'express'])
            ],
            'tasks.*.name' => 'required',
            'tasks.*.local_dir' => 'required',
            'tasks.*.handle_params' => 'required|array',
        ]);
    }
}