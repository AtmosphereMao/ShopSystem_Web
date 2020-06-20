$(document).ready(function () {


});
function Pagedelete(username)
{
    layer.confirm('你确定要删除这位用户吗?', {
        btn: ['确定', '取消']
    },function () {
        var url = window.location.pathname;
        $.post( url+"/delete",{'_method':'delete','_token':$('meta[name="csrf-token"]').attr('content'),'username':username},function (data) {
            if(data.status==0){
                layer.msg(data.msg,{icon:6,time: 800,});
                setTimeout(function () {location.href=location.href;},800);
            }else{
                layer.msg(data.msg,{icon:5,time: 800,});
            }
        });
    },function () {

    });
};