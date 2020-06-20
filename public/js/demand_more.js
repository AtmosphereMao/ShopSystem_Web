$(document).ready(function () {
    if ($('.media').length >= 16)
    {
        $('#media_box').after('<button type="button" id="more" class="btn btn-primary btn-lg btn-block">加载更多信息</button>');
    }
    $('#more').click(function () {
        $.post('',{
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'count' : $('.media').length
        },function (data) {
            if(data=="")
            {
                $('#more').remove();
                $('#media_box').append('<center style="margin-top: 10px;" class="text-black-50">已全部显示</center>');
            }
            $('#media_box').append(data);
        });
    });
});