 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
  <script src="/js/jquery.form.js"></script>
  <script src="/js/jquery.uploadfile.js"></script>
  <script src="/js/qrcode.js"></script>

  <input type="text" name="account" placeholder="账号">
  <input type="password" name="password" placeholder="密码">
  <button id="login">登录</button>
  
  <div id="fileuploader">Upload</div><br><br><br>
  <div id="preview">
  </div>

  <script>
    var access_token;
    var qrcode;
    $('#login').on('click', function() {
        var account = $("input[name='account']").val();
        var password = $("input[name='password']").val()
        $.ajax({
            type: 'POST',
            url: '/api/auth',
            data: {
                account: account,
                password: password,
            },
            success: function(data) {
                if(data.err_code == 0) {
                    alert(data.user.username + " 临时登录成功");
                    console.log(data.access_token);
                    access_token = data.access_token;
                    $("#fileuploader").uploadFile({
                        url: "/api/upload/file",
                        fileName: "myfile",
                        maxFileSize: 50*1024*1024,
                        multiple: false,
                        maxFileCount: 1,
                        acceptFiles: "image/jpeg",
                        showDelete: false,
                        showPreview: false,
                        headers: {
                            "Authorization": "Bearer " + access_token
                        },
                        deleteCallback: function (data, pd) {
                            var data = JSON.parse(data);
                            for (var i = 0; i < data.length; i++) {
                                $.post("/api/upload/delete", {op: "delete",name: data[i]});
                            }
                            $("input[name='cover_image']").val('');
                            pd.statusbar.hide(); //You choice.

                        },
                        onSuccess:function(files,data,xhr,pd) {
                            // $("input[name='cover_image']").val(JSON.parse(data)[0])
                            console.log(data);
                            if (data.err_code == 0) {
                                var data = JSON.parse(data)[0];
                                $("#preview").empty();
                                $("#preview").append("<p style='color:red; font-size: 24px;'>登录已失效，请刷新后重新登录!<p/><div id='qrcode'></div><br><a href='" + data.url + "' target='_blank'>" + data.url + "</a>")
                                qrcode = new QRCode("qrcode", {
                                    text: data.url,
                                    width: 256,
                                    height: 256,
                                    colorDark : "#000000",
                                    colorLight : "#ffffff",
                                    correctLevel : QRCode.CorrectLevel.H
                                });
                            } else {
                                alert(data.err_msg);
                            }
                            
                        },
                    });
                } else {
                    alert(data.err_msg);
                }
            },
            error: function(err) {
                console.log(err);
                alert(err);
            }
        })
    })
   

  </script>

</body>
</html>