$(document).ready(function () {
    $("#all").change(function () {
        var flag = $(this).is(":checked");
        $("input[type=checkbox]").each(function () {
            $(this).prop("checked", flag);
        })
    });
});
layui.use(['laydate','element','laypage','layer'], function(){
    $ = layui.jquery;//jquery
    laydate = layui.laydate;//日期插件
    lement = layui.element();//面包导航
    layer = layui.layer;//弹出层

    document.getElementById('LAY_demorange_s').onclick = function(){
        start.elem = this;
        laydate(start);
    }
    document.getElementById('LAY_demorange_e').onclick = function(){
        end.elem = this
        laydate(end);
    }
});

//批量删除提交
function delAll () {
    layer.confirm('确认要删除吗？',function(index){
        var id = new Array();
        $("input[name=checkbox]:checkbox:checked").each(function(){
            id.push($(this).val());
        });
        if(id=='')
        {
            layer.msg("删除失败，请选择要删除的内容", {icon: 5, time: 800});
            return false;
        }
        id = JSON.stringify(id);
        $.post('myTrends/delete', {
            '_method': 'delete',
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'id': id
        }, function (data) {
            if (data.status == 0) {
                layer.msg(data.msg, {icon: 6, time: 800});
                setTimeout(function () {
                    location.href = location.href;
                }, 800);
            } else {
                layer.msg(data.msg, {icon: 5, time: 800});
            }
        });
    });
}

function question_show (argument) {
    layer.msg('可以跳到前台具体问题页面',{icon:1,time:1000});
}
//编辑
function question_edit (title,url,id,w,h) {
    x_admin_show(title,url,w,h);
}

/*删除*/
function question_del(obj,id){
    layer.confirm('确认要删除吗？',{ btn: ['确定', '取消'] },function(){
        //发异步删除数据
        $.post("myTrends/delete",{'_method':'delete','_token':$('meta[name="csrf-token"]').attr('content'),'id':id},function (data) {
            if(data.status==0){
                $(obj).parents("tr").remove();
                layer.msg(data.msg,{icon:6,time: 800,});
                // setTimeout(function () {location.href=location.href;},800);
            }else{
                layer.msg(data.msg,{icon:5,time: 800,});
            }
            var t=setTimeout("location.reload()",1000);
            t();

        });
    });
}
var _hmt = _hmt || [];
(function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();
function onTransition(src)
{
    window.location.href=src;
}