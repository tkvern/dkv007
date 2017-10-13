@extends('layouts.dashboard')
@section('page_heading','图片活动')
@section('section')
    <div class="col-sm-12">
        @section ('activities_panel_title','图片活动列表')
        @section ('activities_panel_body')
            <p>
              <a href="{{ url('/activity_images/create') }}" class="btn btn-default btn-primary">创建活动&nbsp;<i class="fa fa-plus"></i></a>
            </p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>活动名称</th>
                            <th>活动编号</th>
                            <th>点击次数</th>
                            <th>活动链接</th>
                            <th>创建时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                        <tr>
                            <td>{{ $activity->title }}</td>
                            <td>{{ $activity->activity_no }}</td>
                            <td>{{ $activity->click }}</td>
                            <td><a href="{{ config('app.url') }}/share/activity_image/{{ $activity->activity_no }}" target="_blank">{{ config('app.url') }}/share/activity_images/{{ $activity->activity_no }}</a></td>
                            <td>{{ $activity->created_at }}</td>
                            <td>
                                @if (empty($activity->title))
                                    <span class="label label-warning">未设置属性</span>&nbsp;&nbsp;&nbsp;
                                @endif

                                @if ($activity->public == 0)
                                    <span class="label label-info">未开启</span>&nbsp;&nbsp;&nbsp;
                                @else
                                    <span class="label label-success">已开启</span>&nbsp;&nbsp;&nbsp;
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="{{ $activity->path() . '/edit' }}">
                                    配置活动
                                </a>&nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" onclick="showQRCode('{{ config('app.url') }}/share/activity_images/{{ $activity->activity_no }}')">
                                    查看二维码
                                </button>&nbsp;&nbsp;&nbsp;
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-right">
                {{ $activities->links() }}
            </div>

            <div class="modal fade" tabindex="-1" role="dialog"  id="image_modal">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">查看二维码</h4>
                        </div>
                        <div class="modal-body">
                            <p>请使用手机扫描或右键保存</p>
                            <div id="preview"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'activities'))
    </div>
@stop

@section('script')
    <script src="/js/qrcode.js"></script>
    <script>
    var qrcode;
    var count = 0;


    function showQRCode(url) {
        $("#preview").empty();
        $("#preview").append("<div id='qrcode'></div>");
        qrcode = new QRCode("qrcode", {
            text: url,
            width: 200,
            height: 200,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
        $("#preview img")[0].style.margin = "0 auto";
        $('#image_modal').modal('show');
    }
  </script>
@stop