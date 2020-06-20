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

    if ($('tr').length >= 16)
    {
        $('#media_box').after('<button type="button" id="more" class="btn btn-primary btn-lg btn-block">加载更多信息</button>');
    }
    $('#more').click(function () {
        alert($('tr').length);
        $.post('',{
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'count' : $('tr').length
        },function (data) {
            if(data=="")
            {
                $('#more').remove();
                $('#media_box').append('<center style="margin-top: 10px;" class="text-black-50">已全部显示</center>');
            }
            $('tbody').append(data);
        });
    });
    $(".delete").click(function(){
        var user_id = $(this).parent('td').parent('tr').attr('id');
        layer.confirm('你确定要这位用户重交文件吗?', {
            btn: ['确定', '取消']
        },function () {
            var url = window.location.pathname;
            $.post( url+"/delete",{'_method':'delete','_token':$('meta[name="csrf-token"]').attr('content'),'user_id':user_id},function (data) {
                if(data.status==0){
                    layer.msg(data.msg,{icon:6,time: 800,});
                    setTimeout(function () {location.href=location.href;},800);
                }else{
                    layer.msg(data.msg,{icon:5,time: 800,});
                }
            });
        },function () {

        });
    });
    $(".download_user").click(function () {
        var url = window.location.pathname;
        $.FormPost(url+"/download",{user_id:$(this).parent('td').parent('tr').attr('id')});

    });
    $(".download_all").click(function () {
        var url = window.location.pathname;
        var index = layer.load(1, {
            shade: [0.1,'#fff'] //0.1透明度的白色背景
        });
        //此处用setTimeout演示ajax的回调
        setTimeout(function(){
            layer.close(index);
        }, 1500);

        $.FormPost(url+"/download/all",{user_id:$(this).parent('td').parent('tr').attr('id')});


    });
    $('.state_on').click(function () {
        var str = window.location.pathname;
        var index = str .lastIndexOf("\/");
        str  = str .substring(index + 1, str .length);
        window.location.href = "../on/"+str;

    });
    $('.state_off').click(function () {
        var str = window.location.pathname;
        var index = str .lastIndexOf("\/");
        str  = str .substring(index + 1, str .length);
        window.location.href = "../off/"+str;
    });
    $('.complete').click(function () {
        layer.confirm('你确定审阅完毕吗?审阅完毕后将无法撤回！', {
            btn: ['确定', '取消']
        },function () {
            var url = window.location.pathname;
            $.post( url+"/complete",{'_method':'patch','_token':$('meta[name="csrf-token"]').attr('content')},function (data) {
                if(data.status==0){
                    layer.msg(data.msg,{icon:6,time: 800,});
                    setTimeout(function () {location.href=location.href;},800);
                }else{
                    layer.msg(data.msg,{icon:5,time: 800,});
                }
            });
        },function () {

        });
    });
});