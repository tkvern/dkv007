<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    //
    public function index(Request $request) {
        $user = $request->user();
        $tasks = $user->tasks()->orderBy('updated_at', 'desc')->paginate(10);
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function show(Request $request, $task_id) {
        $user = $request->user();
        $task = $user->tasks()->findOrFail($task_id);
        return view('tasks.show', ['task' => $task]);
    }
}
