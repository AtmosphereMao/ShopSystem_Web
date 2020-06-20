$(document).ready(function () {


});
function FromConfirm() {
        var form = $('#reportFrom');
        layer.confirm('确定要保存吗?', {
            btn: ['确定', '取消']
        }, function(){
                layer.msg('保存中，请稍候。', {icon: 1});
                form.submit();
            },
            function(){
                return false;
            }
        );
    return false;
}