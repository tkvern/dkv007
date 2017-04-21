<?php
/**
 * Created by PhpStorm.
 * User: liujun
 * Date: 2017/4/1
 * Time: 下午4:44
 */

namespace App\Http\API;

use App\Models\Task;
use App\Models\TaskOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        $tasks = $user->tasks()->orderBy('created_at', 'desc');
        $tasks->with('order');
        if ($request->input('handle_state')) {
            $tasks = $tasks->where('handle_state', $request->input('handle_state'));
        }
        if ($request->input('deliver_type')) {
            $tasks = $tasks->where('deliver_type', $request->input('deliver_type'));
        }
        return $this->paginateJsonResponse($tasks->paginate(10));
    }

    public function show(Request $request, $task_id) {
        $task = $request->user()->tasks()->findOrFail($task_id);
        return $this->successJsonResponse(['task' => $task]);
    }

    public function updateStorage(Request $request, $task_id) {
        $this->validator($request->input())->validate();
        $task = $request->user()->tasks()->findOrFail($task_id);
        if ($task->deliver_type != 'network') {
            return $this->errorJsonResponse(400, '不是网络上传');
        } else if (!$task->hasPayed()) {
            return $this->errorJsonResponse(400, '未支付');
        } else if ($task->handle_state  != Task::H_RES_PENDING) {
            return $this->errorJsonResponse(400, '未处于等待资源上传状态');
        } else{
            $task->storage_address = $request->input('storage_address');
            $task->handle_state = Task::H_RES_RECEIVED;
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