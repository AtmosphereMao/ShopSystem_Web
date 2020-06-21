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

     $('.orderComplete').click(function () {
        $.post("management/complete", {
            '_method': 'post',
            'order_id': $(this).parent('div').attr('order_id')
        }, function (data) {
            data = JSON.parse(data);
            if (data.status == 0) {
                // $(obj).parents("tr").remove();
                layer.msg(data.msg, {icon: 6, time: 800,});
                setTimeout(function () {location.href=location.href;},800);
            } else {
                layer.msg(data.msg, {icon: 5, time: 800,});
            }

        });
    });

});
function trendShow(id){
    $.get('home/trends/page/'+id,{},function (data) {
        layer.open({
            type: 1,
            // skin: 'layui-layer-rim', //加上边框
            area: ['90%', '80%; max-height:80%;'], //宽高
            title:data.title,
            content: "<div style='margin:1rem' ><p style='font-weight: bolder'>"+data.backbone+"</p><p>"+data.content+"</p><br>"+"<span style='color:darkred'></span>"+data.create_user+"<br>"+"<span style='color: darkred'>  </span>"+data.created_at+"</div>",
        });
    });

}

// function eventShowPage(id){
//     window.location.href="trends/more/"+id;
// }
