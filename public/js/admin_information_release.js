$(document).ready(function() {

    //simplemde-markdown

    // var simplemde = new SimpleMDE({
    //     element: $("#content-simplemde")[0],
    //     insertTexts: {
    //         horizontalRule: ["", "\n\n-----\n\n"],
    //         image: ["![](http://", ")"],
    //         link: ["[", "](http://)"],
    //         table: ["", "\n\n| Column 1 | Column 2 | Column 3 |\n| -------- | -------- | -------- |\n| Text     | Text      | Text     |\n\n"],
    //     },
    // });
    // $('.CodeMirror').inlineattachment({
    //     uploadUrl: 'release/imageupload',
    //     simplemde: simplemde
    // });


    // summernote
    $("#content-summernote").summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 350,
        focus: false,
        lang: 'zh-CN',
        callbacks: {
            onImageUpload: function (files) {
                //上传图片到服务器，使用了formData对象，至于兼容性...据说对低版本IE不太友好
                var formData = new FormData();
                console.log(files[0]);
                // formData.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formData.append('fileData', files[0]);

                $.ajax({
                    url: 'release/imageupload',//后台文件上传接口
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
                            data = JSON.parse(data);
                            $('#content-summernote').summernote('insertImage', data.filename);
                        }

                    }

                });
            }

        }
    });
    // $('.editorselect').selectpicker();
    // $('.editorselect').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
    //     // do something...
    //     selectEditor(clickedIndex);
    // });

    // $('.editor-summernote').hide();
    // function selectEditor(editor) {
    //     switch (editor){
    //         case 1:
    //             $('input[name=editor]').val(0);
    //             $('.editor-summernote').hide();
    //             $('.editor-simplemde').show();
    //             // $('#content-summernote').summernote('code',null);
    //             break;
    //         case 2:
    //             $('input[name=editor]').val(1);
    //             $('.editor-simplemde').hide();
    //             $('.editor-summernote').show();
    //             // simplemde.value("");
    //             break;
    //
    //     }
    // }
});


