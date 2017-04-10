@extends('layouts.dashboard')
@section('page_heading','作业')
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
                                        <td class="text-right">AD2017040111193611</td>
                                    </tr>
                                    <tr>
                                        <td>创建时间</td>
                                        <td class="text-right">2017/04/02 18:22:12</td>
                                    </tr>
                                    <tr>
                                        <td>更新时间</td>
                                        <td class="text-right">2017/04/02 18:22:12</td>
                                    </tr>
                                    <tr>
                                        <td>订单名称</td>
                                        <td class="text-right">recoder-1223</td>
                                    </tr>
                                    <tr>
                                        <td>提交方式</td>
                                        <td class="text-right">邮寄</td>
                                    </tr>
                                    <tr>
                                        <td>订单状态</td>
                                        <td class="text-right">未完成</td>
                                    </tr>
                                    <tr>
                                        <td>支付状态</td>
                                        <td class="text-right"><span class="label label-success">已支付</span></td>
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
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>AD2017040111193611</td>
                                    <td><span class="label label-success">已完成</span></td>
                                    <td>2017/04/02 18:22:12</td>
                                    <td><a href="/tasks/show">详情</a>&nbsp;&nbsp;<a href="#">下载</a></td>
                                </tr>
                                <tr>
                                    <td>AD2017040111193611</td>
                                    <td><span class="label label-primary">处理中</span></td>
                                    <td>2017/04/02 18:22:12</td>
                                    <td><a href="/tasks/show">详情</a></td>
                                </tr>
                                <tr>
                                    <td>AD2017040111193611</td>
                                    <td><span class="label label-primary">处理中</span></td>
                                    <td>2017/04/02 18:22:12</td>
                                    <td><a href="/tasks/show">详情</a></td>
                                </tr>
                                <tr>
                                    <td>AD2017040111193611</td>
                                    <td><span class="label label-primary">处理中</span></td>
                                    <td>2017/04/02 18:22:12</td>
                                    <td><a href="/tasks/show">详情</a></td>
                                </tr>
                                <tr>
                                    <td>AD2017040111193611</td>
                                    <td><span class="label label-primary">处理中</span></td>
                                    <td>2017/04/02 18:22:12</td>
                                    <td><a href="/tasks/show">详情</a></td>
                                </tr>
                                <tr>
                                    <td>AD2017040111193611</td>
                                    <td><span class="label label-primary">处理中</span></td>
                                    <td>2017/04/02 18:22:12</td>
                                    <td><a href="/tasks/show">详情</a></td>
                                </tr>
                                <tr>
                                    <td>AD2017040111193611</td>
                                    <td><span class="label label-primary">处理中</span></td>
                                    <td>2017/04/02 18:22:12</td>
                                    <td><a href="/tasks/show">详情</a></td>
                                </tr>
                                <tr>
                                    <td>AD2017040111193611</td>
                                    <td><span class="label label-primary">处理中</span></td>
                                    <td>2017/04/02 18:22:12</td>
                                    <td><a href="/tasks/show">详情</a></td>
                                </tr>
                                <tr>
                                    <td>AD2017040111193611</td>
                                    <td><span class="label label-primary">处理中</span></td>
                                    <td>2017/04/02 18:22:12</td>
                                    <td><a href="/tasks/show">详情</a></td>
                                </tr>
                                <tr>
                                    <td>AD2017040111193611</td>
                                    <td><span class="label label-primary">处理中</span></td>
                                    <td>2017/04/02 18:22:12</td>
                                    <td><a href="/tasks/show">详情</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'tasks'))
            </div>
        </div>
    </div>
@stop
