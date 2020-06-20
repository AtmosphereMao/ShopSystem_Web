$(function(){
    $.extend({
        FormPost: function (url, args) {
            var form = $("<form method='post'></form>"),
                input;
            form.attr({"action": url});
            //CSRF防护
            form.append("<input type=\"hidden\" name=\"_token\" value=\"" + $('meta[name="csrf-token"]').attr('content') + "\">");
            $.each(args, function (key, value) {
                input = $("<input type='hidden'>");
                input.attr({"name": key});
                input.val(value);
                form.append(input);
            });
            $(document.body).append(form);
            form.submit();
        }
    });
        var url = window.location.host;
        $('#upload').uploadify({
            auto:true,
            multi:false,
            fileTypeExts:'*.zip;',
            fileSizeLimit:32768,
            formData     : {
                '_token'     : $('meta[name="csrf-token"]').attr('content')
            },
            buttonText:'上传文件',
            showUploadedPercent:true,//是否实时显示上传的百分比，如20%
            showUploadedSize:true,
            removeTimeout:9999999,
            uploader: "",
            onUploadStart:function(){
                //alert('开始上传');
            },
            onUploadSuccess:function(file, data, response){
                $(".upload_state span").html("已上传");
                $(".upload_time span").html(parseInt($(".upload_time span").html())+1);

                alert('上传成功');
                // $("#upload").before("<input class='filename' type='hidden' value="+data+">");
            },
            onCancel:function(file) {
                var test = window.location.pathname;
                $.post(test+"/unlink", {
                    '_method': 'delete',
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                }, function (data) {
                    if(data.status=="0")
                    {
                        $(".upload_state span").html("已撤回");
                        alert(data.msg);
                    }else {
                        alert(data.msg);
                    }

                });
            },
            onUploadError:function (file,data) {
                switch(data.status){
                    case 403:
                        if($('.WarningMsg').length>0){
                            $('.WarningMsg').html('上传失败！请联系管理员.<br>理由：上传次数过多.');
                        }else {
                            $("#upload").before("<span class='WarningMsg'>上传失败！请联系管理员.<br>理由：上传次数过多.</span>");
                        }
                        break;
                }
            }
        });
        $('#withdraw').click(function () {
            var test = window.location.pathname;
            $.post(test+"/unlink", {
                '_method': 'delete',
                '_token': $('meta[name="csrf-token"]').attr('content'),
            }, function (data) {
                if(data.status=="0")
                {
                    $(".upload_state span").html("已撤回");
                    alert(data.msg);
                }else {
                    alert(data.msg);
                }

            });
        });
});