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
                                <td>订单号</td>
                                <td class="text-right"><a href="{{ url("orders/{$task->order_no}") }}">{{ $task->order_no }}</a></td>
                            </tr>
                            <tr>
                                <td>作业名</td>
                                <td class="text-right">{{ $task->name }}</td>
                            </tr>
                            <tr>
                                <td>创建时间</td>
                                <td class="text-right">{{ $task->created_at }}</td>
                            </tr>
                            <tr>
                                <td>更新时间</td>
                                <td class="text-right">{{ $task->updated_at }}</td>
                            </tr>
                            <tr>
                                <td>作业状态</td>
                                <td class="text-right">{!! get_color_by_handle_state($task->handle_state, $task->iStateLabel()) !!}</td>
                            </tr>
                            <tr>
                                <td colspan="2">作业参数
                                    <br /><br />
                                    <table class="table table-condensed">
                                        <tr>
                                            <td>输出尺寸</td>
                                            <td class="text-right">{{ implode(', ', $task->getReadableSizeList()) }}</td>
                                        </tr>
                                        <tr>
                                            <td>输出维数</td>
                                            <td class="text-right">{{ implode(', ', $task->getReadableDimensionList()) }}</td>
                                        </tr>
                                        <tr>
                                            <td>视频格式</td>
                                            <td class="text-right">{{ implode(', ', $task->getReadableFormatList()) }}</td>
                                        </tr>
                                        <tr>
                                            <td>播放平台 </td>
                                            <td class="text-right">{{ implode(', ', $task->getReadablePlatformList()) }}</td>
                                        </tr>
                                        <tr>
                                            <td>附加服务 </td>
                                            <td class="text-right">{{ implode(', ', $task->getReadableExtraList()) }}</td>
                                        </tr>
                                    </table>
                                </td>
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
