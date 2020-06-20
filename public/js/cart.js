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

    // if ($('.trend_card').length >= 6) {
    //     $('.row').after('<center><button type="button"  id="more" class="btn btn-primary btn-lg btn-block w-75" style=""><span class="lead">加载更多</span></button></center>');
    // }
    // $('#more').click(function () {
    //     $.post('', {
    //         '_token': $('meta[name="csrf-token"]').attr('content'),
    //         'count': $('.trend_card').length
    //     }, function (data) {
    //         if (data == "") {
    //             $('#more').remove();
    //             $('.row').append('<span style="margin-top: 10px;" class="w-100 text-center">已全部显示</span>');
    //         }
    //         $('.row').append(data);
    //
    //     });
    // });

});
function trendShow(id){
    $.get('home/trends/page/'+id,{},function (data) {
        layer.open({
            type: 1,
            // skin: 'layui-layer-rim', //加上边框
            area: ['90%', 'auto; max-height:80%;'], //宽高
            title:data.title,
            content: "<div style='margin:1rem' ><p style='font-weight: bolder'>"+data.backbone+"</p><p>"+data.content+"</p><br>"+"<span style='color:darkred'></span>"+data.create_user+"<br>"+"<span style='color: darkred'>  </span>"+data.created_at+"</div>",
        });
    });

}
/*删除*/
function cart_del(obj,id){
        //发异步删除数据
        $.post("cart/delete",{'_method':'delete','_token':$('meta[name="csrf-token"]').attr('content'),'id':id},function (data) {
            if(data.status==0){
                $(obj).parents("tr").remove();
                layer.msg(data.msg,{time: 500,});
                // setTimeout(function () {location.href=location.href;},800);
            }else{
                layer.msg(data.msg,{time: 500,});
            }
            var t=setTimeout("location.reload()",1000);
            t();

        });
}
// function eventShowPage(id){
//     window.location.href="trends/more/"+id;
// }
function cartSumbit() {
    layer.confirm('确认要购买吗？', {btn: ['确定', '取消']}, function () {
        //发异步删除数据
        $.post("cart/submit", {
            '_method': 'post',
            '_token': $('meta[name="csrf-token"]').attr('content')
        }, function (data) {
            if (data.status == 0) {
                // $(obj).parents("tr").remove();
                layer.msg(data.msg, {icon: 6, time: 800,});
                setTimeout(function () {location.href=location.href;},800);
            } else {
                layer.msg(data.msg, {icon: 5, time: 800,});
            }
            var t = setTimeout("location.reload()", 1000);
            t();

        });
    });
}