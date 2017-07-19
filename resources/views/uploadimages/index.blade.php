@extends('layouts.dashboard')
@section('page_heading','全景H5')
@section('section')
    <div class="col-sm-12">
        @section ('image_panel_title','全景H5列表')
        @section ('image_panel_body')
            <p class="text-muted">请注意！全景H5链接有效期限为1个月。</p>
            <form method="post" action="{{ url('/upload/store')}}">
                {{ csrf_field() }}
                <div id="fileuploader">Upload</div>
                <div id="uploaddone"></div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>链接</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($images as $image)
                        <tr>
                            <td><a href="{{ $image->link }}" target="_blank">{{ $image->link }}</a></td>
                            <td>{{ $image->created_at }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" onclick="showQRCode('{{ $image->link }}')">
                                    查看二维码
                                </button>
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
    $("#fileuploader").uploadFile({
        url: "/upload/store",
        fileName: "myfile",
        maxFileSize: 300*1024*1024,
        multiple: false,
        maxFileCount: 1,
        acceptFiles: "image/jpeg",
        showDelete: false,
        showPreview: false,
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