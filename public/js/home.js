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

    if ($('.trend_card').length >= 6) {
        $('.row').after('<center><button type="button"  id="more" class="btn btn-primary btn-lg btn-block w-75" style=""><span class="lead">加载更多</span></button></center>');
    }
    $('#more').click(function () {
        $.get('', {
            // '_token': $('meta[name="csrf-token"]').attr('content'),
            'page': Math.ceil($('.trend_card').length / 6) + 1,
            'search' : getQueryVariable('search') ? getQueryVariable('search') : ''
        }, function (data) {
            if (data == "") {
                $('#more').remove();
                $('.box').append('<span style="margin-top: 10px;" class="w-100 text-center">已全部显示</span>');
            }
            $('.box').append(data);

        });
    });
    $('.trend_buy').click(function () {

        $.post('home/trends/buy', {
            // '_token': $('meta[name="csrf-token"]').attr('content'),
            'trend_id': $(this).parent('div').attr('trend_id')
        }, function (data) {
            data = JSON.parse(data);
            if(data.status==0){
                layer.msg(data.msg,{time: 600,});
                // setTimeout(function () {location.href=location.href;},800);
            }else{
                layer.msg(data.msg,{icon:5,time: 800,});
            }
        });

    });
    $('.trend_export').click(function () {
        StandardPost('home/trends/export/markdown',
            {'trend_id': $(this).parent('div').attr('trend_id')}
        )});
        function StandardPost(url, args) {
            var form = $("<form method='post' action=''></form>"),
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
function trendShow(id){
    $.get('home/trends/page?page_id='+id,{},function (data) {
        data = JSON.parse(data);
        layer.open({
            type: 1,
            // skin: 'layui-layer-rim', //加上边框
            area: ['90%', '80%; max-height:80%;'], //宽高
            title:data.title,
            content: "<div style='margin:1rem' ><p style='font-weight: bolder'>"+data.backbone+"</p><p>"+data.content+"</p><br>"+"<span style='color:darkred'> 发布者：</span>"+data.create_user+"<br>"+"<span style='color: darkred'> 发布时间:  </span>"+data.created_at+"<br><span style='color: darkred'> Price:  </span>"+data.price+"</br><span style='color: darkred'> Quantity: </span>"+data.quantity+"</div>",        });
    });

}
function trendBuy()
{

}
// function eventShowPage(id){
//     window.location.href="trends/more/"+id;
// }

function getQueryVariable(variable)
{
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
    }
    return(false);
}