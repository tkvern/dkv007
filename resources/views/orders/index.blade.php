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
                                        <th>提交方式</th>
                                        <th>支付状态</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>AD2017040111193611</td>
                                        <td>recoder-1223</td>
                                        <td>邮寄</td>
                                        <td><span class="label label-success">已支付</span></td>
                                        <td>2017/04/02 18:22:12</td>
                                        <td><a href="/tasks">查看作业</a></td>
                                    </tr>
                                    <tr>
                                        <td>AD2017040111193611</td>
                                        <td>recoder-1223</td>
                                        <td>邮寄</td>
                                        <td><span class="label label-danger">未支付</span></td>
                                        <td>2017/04/02 18:22:12</td>
                                        <td><a href="/tasks">查看作业</a></td>
                                    </tr>
                                    <tr>
                                        <td>AD2017040111193611</td>
                                        <td>recoder-1223</td>
                                        <td>邮寄</td>
                                        <td><span class="label label-info">免费</span></td>
                                        <td>2017/04/02 18:22:12</td>
                                        <td><a href="/tasks">查看作业</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endsection
                    @include('widgets.panel', array('header'=>true, 'as'=>'orders'))
            </div>
        </div>
    </div>
@stop
