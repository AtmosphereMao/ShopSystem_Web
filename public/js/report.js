$(document).ready(function () {


});
function FromConfirm() {
        var form = $('#reportFrom');
        layer.confirm('你确定要报送这个活动吗?', {
            btn: ['确定', '取消']
        }, function(){
                layer.msg('报送中，请稍候。', {icon: 1});
                form.submit();
            },
            function(){
                return false;
            }
        );
    return false;
}