$(document).ready(function () {


});

function deleteNotify(page_id){
    layer.confirm('你确定要删除这条消息吗?', {
        btn: ['确定', '取消']
    },function () {
        $.post("notify/delete",{'_method':'delete','_token':$('meta[name="csrf-token"]').attr('content'),'page_id':page_id},function (data) {
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
function putNotify(page_id) {
    layer.confirm('你确定要 上/下架 这条消息吗?', {
        btn: ['确定', '取消']
    },function () {
        $.post("notify/put",{'_method':'patch','_token':$('meta[name="csrf-token"]').attr('content'),'page_id':page_id},function (data) {
            if(data.status==0){
                layer.msg(data.msg,{icon:6,time: 800});
                setTimeout(function () {location.href=location.href;},800);
            }else{
                layer.msg(data.msg,{icon:5,time: 800});
            }
        });
    },function () {

    });
};