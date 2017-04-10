@extends('layouts.dashboard')
@section('page_heading','作业详情')
@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-4">
                @section ('order_panel_title','作业详情')
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
                                        <td>作业状态</td>
                                        <td class="text-right"><span class="label label-success">已完成</span></td>
                                    </tr>
                                    <tr>
                                        <td>订单号</td>
                                        <td class="text-right">AD2017040111193611</td>
                                    </tr>
                                    <tr>
                                        <td>作业名</td>
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
                                        <td colspan="2">作业参数
                                        <br /><br />
                                          <table class="table table-condensed">
                                            <tr>
                                              <td>尺寸</td>
                                              <td class="text-right">8K</td>
                                            </tr>
                                            <tr>
                                              <td>调色服务</td>
                                              <td class="text-right">否</td>
                                            </tr>
                                            <tr>
                                              <td>修图服务</td>
                                              <td class="text-right">否</td>
                                            </tr>
                                            <tr>
                                              <td>序列帧</td>
                                              <td class="text-right">是</td>
                                            </tr>
                                          </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>成片地址</td>
                                        <td class="text-right"><a href="#">下载</a></td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'order', 'class'=>'success'))
            </div>
        </div>
    </div>
@stop
