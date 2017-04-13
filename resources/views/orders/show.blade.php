@extends('layouts.dashboard')
@section('page_heading','订单详情')
@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-4">
                @section ('order_panel_title','订单详情')
                @section ('order_panel_body')
                    <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>订单号</td>
                                        <td class="text-right">{{ $order->out_trade_no }}</td>
                                    </tr>
                                    <tr>
                                        <td>订单名称</td>
                                        <td class="text-right">{{ $order->trade_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>创建时间</td>
                                        <td class="text-right">{{ $order->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <td>更新时间</td>
                                        <td class="text-right">{{ $order->updated_at }}</td>
                                    </tr>
                                    <tr>
                                        <td>提交方式</td>
                                        <td class="text-right">{{ $order->iDeliverLabel() }}</td>
                                    </tr>
                                    <tr>
                                        <td>支付状态</td>
                                        <td class="text-right">{!! get_color_by_pay_state($order->pay_state, $order->iPayStateLabel()) !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'order', 'class'=>'success'))
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8">
                @section ('tasks_panel_title','作业列表')
                @section ('tasks_panel_body')
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>作业名</th>
                                    <th>作业状态</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->tasks as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td>{!! get_color_by_handle_state($task->handle_state, $task->iStateLabel()) !!}</td>
                                    <td>{{ $task->updated_at }}</td>
                                    <td><a href="{{ url("tasks/{$task->id}") }}">详情</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'tasks'))
            </div>
        </div>
    </div>
@stop
