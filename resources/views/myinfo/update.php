<!DOCTYPE html>
<!-- saved from url=(0050)https://v4.bootcss.com/docs/4.0/examples/carousel/ -->
<html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="<?=asset('favicon.ico')?>">

    <title><?=env('APP_NAME')?></title>
    <!-- Bootstrap core CSS -->
    <link href="<?=asset('css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=asset('css/carousel.css')?>" rel="stylesheet">

    <link href="<?=asset('css/custom.css?version=1.1.0')?>" rel="stylesheet" type="text/css">
    <script src="<?=asset('js/jquery.min.js')?>"></script>
    <script src="<?=asset('js/main.js')?>"></script>

    <link rel="stylesheet" href="<?=asset('lib/layui/css/layui.css')?>">
    <script src="<?=asset('lib/layui/layui.js')?>" charset="utf-8"></script>

    <script src="<?=asset('js/x-layui.js')?>" charset="utf-8"></script>
    <script src="<?=asset('js/admin.js')?>"></script>

    <script src="<?=asset('js/information/myinfo.js')?>"></script>
    <script src="<?=asset('js/information/trends_edit.js')?>"></script>
    <script type="text/javascript" src="<?=asset('js/summernote.js')?>" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script type="text/javascript" src="<?=asset('js/admin_information_release.js')?>"></script>



</head>
<body>
<main role="main">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?= __('修改商品内容') ?></div>

                <div class="card-body">
                    <form class="layui-form layui-form-pane" action="" method="post" style="margin-bottom: 30px; margin-left: -10px;">

                        <div class="form-group">

                            <?php if(count($msg)>0) { ?>
                            <div class="error">
                                <?php foreach ($msg as $value) { ?>
                                <p class="WarningMsg"><?=$value?></p>
                                <?php } ?>
                            </div>
                            <?php }?>
                            <?php if($redirect) { ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    layer.alert("保存成功", {icon: 6},function () {
                                        // 获得frame索引
                                        var index = parent.layer.getFrameIndex(window.name);
                                        //关闭当前frame
                                        parent.layer.close(index);
                                    });
                                });
                            </script>
                            <?php } ?>
                            <span class="required">*</span>
                            <label for="article-title">标题</label>
                            <input type="text" class="form-control" id="article-title" name="title" value="<?=$trend['title']?>" placeholder="标题">
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                            <label for="article-backbone">主干</label>
                            <input type="text" class="form-control" id="article-title" name="backbone" value="<?=$trend['backbone']?>" placeholder="尽量在主干里说明主旨">
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                            <label for="summernote">正文</label>
                            <!-- <form method="post"> -->
                            <textarea class="form-control" id="content-summernote" rows="20" name="content_summernote"  ><?=$trend['content']?></textarea>

                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                            <label for="summernote">价格</label>
                            <input type="text" class="form-control" id="article-title" name="price" readonly value="<?=$trend['price']?>" placeholder="标价">
                        </div>
                        <div class="form-group">
                            <span class="required">*</span>
                            <label for="summernote">库存数量</label>
                            <input type="text" class="form-control" id="article-title" name="quantity" value="<?=$trend['quantity']?>" placeholder="数量">

                        </div>
                        <div class="layui-form-item">
                            <button class="layui-btn btn btn-primary col-md-3" lay-filter="add" lay-submit>
                                保存
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


<script src="<?=asset("js/bootstrap.bundle.min.js")?>"></script>
<svg xmlns="http://www.w3.org/2000/svg" width="500" height="500" viewBox="0 0 500 500" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="25" style="font-weight:bold;font-size:25pt;font-family:Arial, Helvetica, Open Sans, sans-serif">500x500</text></svg></body></html>