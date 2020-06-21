<?php view('layouts/header') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">-->
<!--    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>-->
    <script type="text/javascript" src="<?=asset('js/admin_information_release.js')?>"></script>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?= __('发布商品') ?></div>

                <div class="card-body">
                    <form action="" method="post" style="margin-bottom: 30px; margin-left: -10px;">

                        <div class="form-group layui-form-item">

                            <?php if(count($msg)>0) { ?>
                            <div class="error">
                                <?php foreach($msg as $item) {?>
                                <p class="WarningMsg"><?=$item?></p>
                                <?php } ?>
                            </div>
                            <?php } ?>
                            <span class="required">*</span>
                            <label for="article-title" class="layui-form-label">标题</label>
                            <div class="layui-input_block">
                                <input type="text" class="form-control" id="article-title" lay-verify="title" name="title" value="" placeholder="标题">
                            </div>
                        </div>
                        <div class="form-group layui-form-item">
                            <span class="required">*</span>
                            <label for="article-backbone" class="layui-form-label">主干</label>
                            <div class="layui-input-block">
                                <input type="text" class="form-control" id="article-title" lay-verify="backbone" name="backbone" value="" placeholder="尽量在主干里说明主旨">
                            </div>
                        </div>
                        <div class="form-group layui-form-item layui-form-text">
                            <span class="required">*</span>
                            <label for="summernote">正文</label>
                            <div class="editor-summernote">
                                <textarea class="form-control" id="content-summernote" rows="20" name="content_summernote" ></textarea>
                            </div>

                        </div>
                        <div class="form-group layui-form-item">
                            <span class="required">*</span>
                            <label for="summernote">价格</label>
                            <div class="layui-input-block">
                                <input type="text" class="form-control" id="article-price" lay-verify="price" name="price" value="" placeholder="标价">
                            </div>
                        </div>
                        <div class="form-group layui-form-item">
                            <span class="required">*</span>
                            <label for="summernote">库存数量</label>
                            <div class="layui-input-block">
                                <input type="text" class="form-control" id="article-quantity" lay-verify="quantity" name="quantity" value="" placeholder="数量">
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" id="article-preview" style="display:none;">预览正文</button>
                        <button type="sumbit" class="btn btn-primary col-md-3" id="article-publish">立即发布</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php view('layouts/footer') ?>