$(document).ready(function () {

});

function deleteReport(page_id){
    layer.confirm('你确定要删除这条消息吗?', {
        btn: ['确定', '取消']
    },function () {
        $.post("my_report/delete",{'_method':'delete','_token':$('meta[name="csrf-token"]').attr('content'),'page_id':page_id},function (data) {
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
function putReport(page_id) {
    $.post("my_report/reply",{'_token':$('meta[name="csrf-token"]').attr('content'),'page_id':page_id},function (data) {
        if(data.status==0){
            layer.confirm('撤回理由：'+data.msg,{
                btn:['重发','取消']
            },function () {
                location.href = "my_report/"+page_id+"/edit";
            },function () {

            });


        }else{
            layer.msg(data.msg,{icon:5,time: 800,});
        }
    });
};
