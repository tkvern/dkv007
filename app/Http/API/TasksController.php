<?php
/**
 * Created by PhpStorm.
 * User: liujun
 * Date: 2017/4/1
 * Time: 下午4:44
 */

namespace App\Http\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    public function show(Request $request, $task_id) {
        $task = $request->user()->tasks()->findOrFail($task_id);
        return $this->successJsonResponse(['task' => $task]);
    }

    public function updateStorage(Request $request, $task_id) {
        $this->validator($request->input())->validate();
        $task = $request->user()->tasks()->findOrFail($task_id);
        if ($task->deliver_type != 'network') {
            return $this->errorJsonResponse(400, '不是网络上传');
        } else if ($task->pay_state != 'pay_free' && $task->pay_state != 'pay_success') {
            return $this->errorJsonResponse(400, '未支付');
        } else {
            $task->storage_address = $request->input('storage_address');
            $task->handle_state = 'resource_uploaded';
            $task->save();
            return $this->successJsonResponse();
        }
    }

    private function validator($data) {
        return Validator::make($data, [
            'storage_address' => 'required|max:255'
        ]);
    }
}