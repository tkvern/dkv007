@extends('layouts.dashboard')
@section('page_heading','全景活动信息')
@section('section')
    <div class="col-sm-12">
        @section ('image_panel_title','全景活动图片列表')
        @section ('image_panel_body')
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-10 col-xs-12">
                    <p class="text-danger">&nbsp;&nbsp;&nbsp;&nbsp;请注意！</p>
                    <ol class="text-muted">
                        <li>使用专线上传，以保证服务质量。</li>
                        <li>全景H5链接生成当月有效，次月失效。</li>
                        <li>全景图必须为 宽:高 = 2:1</li>
                        <li>全景图仅支持以下分辨率
                            <ul>
                                <li>2K&nbsp;&nbsp;&nbsp;[2048 × 1024]</li>
                                <li>4K&nbsp;&nbsp;&nbsp;[4096 × 2048]</li>
                                <li>6K&nbsp;&nbsp;&nbsp;[6144 × 3072]</li>
                                <li>8K&nbsp;&nbsp;&nbsp;[8192 × 4096][默认]</li>
                                <li>10K[10240 × 5120]</li>
                                <li>20K[20480 × 10240]</li>
                            <ul>
                        </li>
                    </ol>
                    <form method="post" action="{{ url('/upload/store')}}">
                        {{--  {{ csrf_field() }}  --}}
                        <div id="fileuploader">Upload</div>
                        <div id="uploaddone"></div>
                    </form>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-10 col-xs-12">
                    <form class="form-horizontal" role="form" method="POST" action="{{ $activity->path() }}/update">
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-3 col-sm-3 control-label text-right">标题</label>

                                <div class="col-md-7 col-sm-7">
                                    <input 
                                        id="title" 
                                        type="text" 
                                        class="form-control" 
                                        name="title" 
                                        value="{{ old('title', $activity->title) }}"
                                        autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-3 col-sm-3 control-label text-right">描述</label>

                                <div class="col-md-7 col-sm-7">
                                    <textarea 
                                        id="description" 
                                        class="form-control" 
                                        name="description"
                                        rows="8">{{ old('description', $activity->description) }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-md-3 col-sm-3 control-label text-right">开启</label>

                                <div class="col-md-7 col-sm-7">

                                  @if ($activity->public == 0)
                                    <label class="radio-inline">
                                      <input type="radio" name="public" id="inlineRadio1" value="0" checked> 否
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="public" id="inlineRadio2" value="1" > 是
                                    </label>
                                  @elseif ($activity->public == 1)
                                    <label class="radio-inline">
                                      <input type="radio" name="public" id="inlineRadio1" value="0"> 否
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="public" id="inlineRadio2" value="1" checked> 是
                                    </label>
                                  @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7 col-sm-7 col-md-offset-3 col-sm-offset-3">
                                    <button type="submit" class="btn btn-md btn-primary">
                                        保存
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>缩略图</th>
                            <th>标题</th>
                            <th>序号</th>
                            <th>预览链接</th>
                            <th>创建时间</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($images as $image)
                        <tr>
                            <td><img src="{{ $image->link }}panos/{{ $image->key }}.tiles/thumb.jpg" alt="thumb.jpg" height="120" width="120" class="img-thumbnail"></td>
                            <td>{{ $image->title }}</td>
                            <td>{{ $image->number }}</td>
                            <td><a href="{{ $image->link }}" target="_blank">{{ $image->link }}</a></td>
                            <td>{{ $image->created_at }}</td>
                            <td>
                                @if (empty($image->title))
                                    <span class="label label-warning">未设置标题</span>&nbsp;&nbsp;&nbsp;
                                @endif

                                @if ($image->public == 0)
                                    <span class="label label-info">未开启</span>&nbsp;&nbsp;&nbsp;
                                @else
                                    <span class="label label-success">已开启</span>&nbsp;&nbsp;&nbsp;
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="{{ $image->path() . '/edit' }}">
                                    修改属性
                                </a>&nbsp;&nbsp;&nbsp;
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
@stop

@section('script')
    <link href="/css/uploadfile.css" rel="stylesheet">
    <script src="/js/jquery.form.js"></script>
    <script src="/js/jquery.uploadfile.js"></script>
    <script src="/js/qrcode.js"></script>
    <script>
    var access_token;
    var qrcode;
    var count = 0;
    var uploadobj = $("#fileuploader").uploadFile();
    uploadobj.uploadFile({
        url: "/upload/store",
        fileName: "myfile",
        maxFileSize: 300*1024*1024,
        multiple: false,
        maxFileCount: 1,
        acceptFiles: "image/jpeg",
        showDelete: false,
        showPreview: false,
        dragDrop: true,
        headers: {
            "Activity-No": "{{$activity->activity_no}}"
        },
        onSuccess:function(files,data,xhr,pd) {
            if (data.err_code == 0) {
                $("#uploaddone").empty();
                $("#uploaddone").append("<p style='color:red; font-size: 24px;'>已上传成功!正在重新加载列表...<p/>");
                setTimeout(function(){
                    window.location.reload();
                }, 2800);
            } else {
                alert(data.err_msg);
            }
            
        },
        customProgressBar: function(obj,s) {
            this.statusbar = $("<div class='ajax-file-upload-statusbar'></div>");
            this.preview = $("<img class='ajax-file-upload-preview' />").width(s.previewWidth).height(s.previewHeight).appendTo(this.statusbar).hide();
            this.filename = $("<div class='ajax-file-upload-filename'></div>").appendTo(this.statusbar);
            this.progressDiv = $("<div class='ajax-file-upload-progress'>").appendTo(this.statusbar).hide();
            this.progressbar = $("<div class='ajax-file-upload-bar'></div>").appendTo(this.progressDiv);
            this.abort = $("<div>" + s.abortStr + "</div>").appendTo(this.statusbar).hide();
            this.cancel = $("<div>" + s.cancelStr + "</div>").appendTo(this.statusbar).hide();
            this.done = $("<div>" + s.doneStr + "</div>").appendTo(this.statusbar).hide();
            this.download = $("<div>" + s.downloadStr + "</div>").appendTo(this.statusbar).hide();
            this.del = $("<div>" + s.deletelStr + "</div>").appendTo(this.statusbar).hide();
            
            this.abort.addClass("custom-red");
            this.done.addClass("custom-green");
            this.download.addClass("custom-green");            
            this.cancel.addClass("custom-red");
            this.del.addClass("custom-red");
            if(count++ %2 ==0)
                this.statusbar.addClass("even");
            else
                this.statusbar.addClass("odd"); 
            return this;
            
        },
        onSelect: function(files) {
            var file = files[0];
            var reader = new FileReader();
            var ret = [];
            reader.onload = function(theFile) {
                var image = new Image();
                image.src = theFile.target.result;
                image.onload = function() {
                    if (this.width/this.height != 2) {
                        uploadobj.stopUpload();
                        alert("全景图必须为 宽:高 = 2:1");
                    }
                };
            }
            reader.readAsDataURL(file);
        }
    });

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