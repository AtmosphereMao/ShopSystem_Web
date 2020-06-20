$(document).ready(function() {

    // if ()
    $("#content-summernote").summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 200,
        focus: false,
        lang: 'zh-CN',
        callbacks: {
            onImageUpload: function (files) {
                //上传图片到服务器，使用了formData对象，至于兼容性...据说对低版本IE不太友好
                var formData = new FormData();
                console.log(files[0]);
                formData.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formData.append('fileData', files[0]);

                $.ajax({
                    url: '../imageupload',//后台文件上传接口
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        // alert(data);
                        if(data=="Error"){
                            layer.alert('文件上传失败！请重试',{
                                icon:2,
                            });
                        }else{
                            $('#content-summernote').summernote('insertImage', data);
                        }

                    }

                });
            }

        }
    });



});
layui.use(['form','layer'], function() {
    $ = layui.jquery;
    var form = layui.form()
        , layer = layui.layer;

    //监听提交
    form.on('submit()', function (data) {
        console.log(data);
        //发异步，把数据提交给php
        layer.alert("保存成功", {icon: 6}, function () {
            // 获得frame索引
            var index = parent.layer.getFrameIndex(window.name);
            //关闭当前frame
            parent.layer.close(index);
        });
        return false;
    });
});
var _hmt = _hmt || [];
(function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();
