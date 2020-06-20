$(document).ready(function () {


});
function deleteHandle(page_id){
    layer.confirm('你确定要删除这条报送吗?', {
        btn: ['确定', '取消']
    },function () {
        $.post("handle/delete",{'_method':'delete','_token':$('meta[name="csrf-token"]').attr('content'),'page_id':page_id},function (data) {
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

function passHandle(page_id) {
    layer.confirm('你确定要 通过/撤销 这条消息吗?', {
        btn: ['确定', '取消']
    },function () {
        $.post("handle/pass",{'_method':'patch','_token':$('meta[name="csrf-token"]').attr('content'),'page_id':page_id},function (data) {
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
function undoHandle(page_id) {
    layer.prompt({title: '撤回理由：', formType: 2}, function(text, index){
        layer.close(index); 
        $.post("handle/undo",{'_method':'put','_token':$('meta[name="csrf-token"]').attr('content'),'page_id':page_id,'reason':text},function (data) {
            if(data.status==0){
                layer.msg(data.msg,{icon:6,time: 800});
                setTimeout(function () {location.href=location.href;},800);
            }else{
                layer.msg(data.msg,{icon:5,time: 800});
            }
        });
    });
};
