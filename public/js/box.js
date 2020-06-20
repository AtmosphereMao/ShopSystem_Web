$(document).ready(function () {
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

    $('.box_card').hover(function(){
        $(this).children('.card').children('.box_hidden_action').show();
    },function(){
        $(this).children('.card').children('.box_hidden_action').hide();
    });

    $('.file_download').click(function () {

        var url = window.location.host;
    //     StandardPost("http://"+url+'/box/download/file',
    //         {'file_key': $(this).parent('div').attr('file_key')}
    //     )});
    // function StandardPost(url, args) {
    //     var form = $("<form method='post' action=''></form>"),
    //         input;
    //     form.attr({"action": url});
    //     //CSRF防护
    //     form.append("<input type=\"hidden\" name=\"_token\" value=\"" + $('meta[name="csrf-token"]').attr('content') + "\">");
    //     $.each(args, function (key, value) {
    //         input = $("<input type='hidden'>");
    //         input.attr({"name": key});
    //         input.val(value);
    //         form.append(input);
    //     });
    //
    //     $(document.body).append(form);
    //     form.submit();
    // }

        $.post("http://"+url+'/box/download/file', {
            '_method': 'post',
            'file_key': $(this).parent('div').attr('file_key'),
            '_token': $('meta[name="csrf-token"]').attr('content'),
        }, function (data) {
            console.log(data);
            if (data.status == 0) {
                layer.msg(data.msg, {time: 800});
                window.open(data.url);
                // setTimeout(function () {location.href=location.href;},800);
            } else {
                layer.msg(data.msg, {time: 800});
            }
        });
    });
    $('.file_delete').click(function () {
        var file_key =  $(this).parent('div').attr('file_key');
        layer.confirm('确定删除该文件吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            var url = window.location.host;
            $.post("http://"+url+'/box/delete/file', {
                '_method': 'delete',
                'file_key': file_key,
                '_token': $('meta[name="csrf-token"]').attr('content'),
            }, function (data) {
                console.log(data);
                if (data.status == 0) {
                    layer.msg(data.msg, {time: 800});
                    setTimeout(function () {location.href=location.href;},800);
                } else {
                    layer.msg(data.msg, {time: 800});
                }
            });
        }, function(){
        });

    });

    $(function(){
        var url = window.location.host;
        $('#upload').uploadify({
            auto:true,
            multi:true,
            formData     : {
                '_token'     : $('meta[name="csrf-token"]').attr('content'),
                'prefix'     : ""
            },
            buttonText:'选择文件',
            showUploadedPercent:true,//是否实时显示上传的百分比，如20%
            showUploadedSize:true,
            removeTimeout:9999999,
            uploader: "http://"+url+'/box/upload/file',
            onUploadStart:function(){
                //alert('开始上传');
                $('.queue_list_now').text(parseInt($('.queue_list_now').text())+1);
            },
            onUploadComplete:function(file, data, response){
                data = jQuery.parseJSON(data);
                $("#upload").before("<input class='filename' type='hidden' value="+data.prefix+file.name+">");
                $('#box_iframe').attr('src',"http://"+url+'/box/simple/page?prefix='+$('#box_iframe').contents().find('meta[name="prefix"]').attr('content'));
                $('.queue_list_now').text(parseInt($('.queue_list_now').text())-1);
                $('.queue_list_finished').text(parseInt($('.queue_list_finished').text())+1);
            },
            onCancel:function(file){
                $('.filename').each(function () {
                    var isset =$(this).val().search(file.name);
                    if(isset>0) {
                        $.post("box/unlink/file", {
                            '_method': 'delete',
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'filename': $(this).val()
                        }, function (data) {

                        });
                        $(this).remove();
                        return false;
                    }

                });

            }
        });
    });
});
function showQueue()
{
    $('.upload_box').show();
}
function hideQueue()
{
    $('.upload_box').hide();
}
function createFolder()
{
    layer.prompt({title: '创建文件夹名'}, function(pass, index){
        var url = window.location.host;
        var prefix = $('#box_iframe').contents().find('meta[name="prefix"]').attr('content');
        $.post("http://"+url+'/box/create/folder', {
            '_method': 'post',
            'file_key': (prefix==null?"/":prefix)+ pass,
            '_token': $('meta[name="csrf-token"]').attr('content'),
        }, function (data) {
            console.log(data);
            if (data.status == 0) {
                layer.msg(data.msg, {time: 800});
                document.getElementById('box_iframe').contentWindow.location.reload();
                // setTimeout(function () {location.href=location.href;},800);
            } else {
                layer.msg(data.msg, {time: 800});
            }
        });
        layer.close(index);
    });
}


