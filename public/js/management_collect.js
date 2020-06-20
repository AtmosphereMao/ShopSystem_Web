$(document).ready(function () {
    laydate.render({
        elem: '#SelectDate'
        ,position: 'static'
        ,type: 'time'
        ,change: function(value, date){ //监听日期被切换
            lay('#SelectDateView').html(value);
        }
        ,btns: ['now', 'confirm']
        ,done:function (value, date) {
            var timestamp = Date.parse(date.year+"-"+date.month+"-"+date.date+" "+value) - Date.parse(new Date());
            if(timestamp==0)
            {
                var datetime = Date.parse(date.year+"-"+date.month+"-"+date.date+" "+value);
                var text = "现在";
            }else if(timestamp < 0)
            {
                var datetime =  Date.parse(date.year+"-"+date.month+"-"+date.date+" "+value)+86400000;
                var text = new Date(datetime)
            }else if(timestamp > 0)
            {
                var datetime =  Date.parse(date.year+"-"+date.month+"-"+date.date+" "+value);
                var text = new Date(datetime);
            }
            layer.confirm("你确定要在 '"+text+"' 催交吗?", {
                btn: ['确定', '取消']
            },function () {
                var page_id = $("#SelectText").attr('page_id');
                $.post("collect/urge",{'_token':$('meta[name="csrf-token"]').attr('content'),'page_id':page_id,'datetime_timestamp':datetime},function (data) {
                    if(data.status==0){
                        layer.msg(data.msg,{icon:6,time: 800,});
                        setTimeout(function () {location.href=location.href;},800);
                    }else{
                        layer.msg(data.msg,{icon:5,time: 800,});
                    }
                });
            });
        }
    });

});

function deleteCollect(page_id){
    layer.confirm('你确定要删除这条消息吗?', {
        btn: ['确定', '取消']
    },function () {
        $.post("collect/delete",{'_method':'delete','_token':$('meta[name="csrf-token"]').attr('content'),'page_id':page_id},function (data) {
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
function putCollect(page_id) {
    layer.confirm('你确定要 上/下架 这条消息吗?', {
        btn: ['确定', '取消']
    },function () {
        $.post("collect/put",{'_method':'patch','_token':$('meta[name="csrf-token"]').attr('content'),'page_id':page_id},function (data) {
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
function urgeCollect(page_id) {

    layer.open({
        type: 1,
        skin: 'layui-layer-rim', //加上边框
        area: ['420px', '480px'], //宽高
        content: "<script type=\"text/javascript\" src=\"../../js/management_collect.js?version=1.0.8\"></script><center><p id=\"SelectText\"style=\"width: 280px\" page_id=\""+page_id+"\">只允许选择24小时范围内，如果选择的时间比现在早则时间是第二天的时间</p> <div id=\"SelectDate\"></div></center>"
    });
}


    // layer.confirm('你确定要 上/下架 这条消息吗?', {
    //     btn: ['确定', '取消']
    // },function () {
    //     $.post("collect/urge",{'_token':$('meta[name="csrf-token"]').attr('content'),'page_id':page_id},function (data) {
    //         if(data.status==0){
    //             layer.msg(data.msg,{icon:6,time: 800});
    //             setTimeout(function () {location.href=location.href;},800);
    //         }else{
    //             layer.msg(data.msg,{icon:5,time: 800});
    //         }
    //     });
    // },function () {
    //
    // });
