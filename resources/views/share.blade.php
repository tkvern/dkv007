@extends('layouts.plane')
@section('page_heading','全景H5')
@section('body')
    <div class="col-sm-12">
        <div class="row" style="padding-top: 20px;">
            <div class="col-sm-10 col-sm-offset-1">
                <h1 class="text-center">量子云共享全景H5</h1>
            </div>
        </div>
        <div class="row" style="padding-top: 20px;">
            <div class="col-sm-4 col-sm-offset-7">
                <form
                    role="form" 
                    action="/share" 
                    method="get">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="输入标题搜索共享全景H5" value="{{$search}}">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="row" style="padding-top: 20px;">
            <div class="col-sm-10 col-sm-offset-1">
                @section ('image_panel_title','全景H5列表')
                @section ('image_panel_body')
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>缩略图</th>
                                    <th>标题</th>
                                    <th>链接</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($images as $image)
                                <tr>
                                    <td><img src="{{ $image->link }}panos/{{ $image->key }}.tiles/thumb.jpg" alt="thumb.jpg" height="120" width="120" class="img-thumbnail"></td>
                                    <td>{{ $image->title }}</td>
                                    <td><a href="{{ $image->link }}" target="_blank">{{ $image->link }}</a></td>
                                    <td>{{ $image->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" onclick="showQRCode('{{ $image->link }}')">
                                            查看二维码
                                        </button>&nbsp;&nbsp;&nbsp;
                                        @if (!empty($image->download))
                                        <a class="btn btn-primary btn-xs" target="_blank" download href="{{ $image->download }}">
                                            下载图片
                                        </a>&nbsp;&nbsp;&nbsp;
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pull-right">
                        {{ $images->links() }}
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
                @include('widgets.panel', array('header'=>true, 'as'=>'image'))
            </div>
        </div>
    </div>
@stop

@section('script')
    <link href="/css/uploadfile.css" rel="stylesheet">
    <script src="/js/jquery.form.js"></script>
    <script src="/js/jquery.uploadfile.js"></script>
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