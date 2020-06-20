$(document).ready(function () {
    $(function(){
        var url = window.location.host;
        $('#upload').uploadify({
            auto:true,
            multi:true,
            formData     : {
                '_token'     : $('meta[name="csrf-token"]').attr('content')
            },
            buttonText:'选择文件',
            showUploadedPercent:true,//是否实时显示上传的百分比，如20%
            showUploadedSize:true,
            removeTimeout:9999999,
            uploader: "http://"+url+'/management/release/upload',
            onUploadStart:function(){
            //alert('开始上传');
        },
        onUploadComplete:function(file, data, response){
            $("#upload").before("<input class='filename' type='hidden' value="+data+">");
        },
        onCancel:function(file){
            $('.filename').each(function () {
                var isset =$(this).val().search(file.name);
                if(isset>0) {
                    $.post("release/unlink", {
                        '_method': 'delete',
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'filename': $(this).val()
                    }, function (data) {

                    });
                        $(this).remove();
                    return false;
                }

            });

        }
    });


        $("button[type=submit]").click(function () {
            if($(".filename").length>0) {
                var filename = new Array();
                $(".filename").each(function () {
                    filename.push($(this).val());
                });
                filename = JSON.stringify(filename);
                var input;
                input = $("<input type='hidden'>");
                input.attr({"name": 'filename'});
                input.val(filename);
                $('form').append(input);
            }

        });
    });
});
