@extends('layouts.dashboard')
@section('page_heading','作业')
@section('section')
    <div class="col-sm-12">
        @section ('tasks_panel_title','作业列表')
        @section ('tasks_panel_body')
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>作业名</th>
                            <th>作业状态</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->name }}</td>
                            <td>{!! get_color_by_handle_state($task->handle_state, $task->iStateLabel()) !!}</td>
                            <td>{{ $task->created_at }}</td>
                            <td>{{ $task->updated_at }}</td>
                            <td><a href="{{ url("tasks/{$task->id}") }}">详情</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-right">
                {{ $tasks->links() }}
            </div>
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'tasks'))
    </div>
@stop
