@extends('layouts.dashboard')
@section('page_heading', '订单')
@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-12">
                    @section ('orders_panel_title','订单列表')
                    @section ('orders_panel_body')
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>订单号</th>
                                        <th>订单名称</th>
                                        <th>素材递交方式</th>
                                        <th>支付状态</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->out_trade_no }}</td>
                                        <td>{{ $order->trade_name }}</td>
                                        <td>{{ $order->iDeliverLabel() }}</td>
                                        <td>{!! get_color_by_pay_state($order->pay_state, $order->iPayStateLabel()) !!}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td><a href="{{ url("/orders/{$order->out_trade_no}") }}">详情</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pull-right">
                            {{ $orders->links() }}
                        </div>
                    @endsection
                    @include('widgets.panel', array('header'=>true, 'as'=>'orders'))
            </div>
        </div>
    </div>
@stop
