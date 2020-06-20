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
    $("#already").click(function () {
        var url = window.location.pathname;
        $.FormPost(url+"/already",{page_id:$(this).attr('page_id')});
    });
    $(".downfile").click(function () {
        $.FormPost("download",{file_name:$(this).parent('div').attr('file_name'),path_name:$(this).parent('div').attr('path_name')});
    });

});