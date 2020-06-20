<?php view('layouts/header') ?>
    <link rel="stylesheet" href="<?=asset('lib/layui/css/layui.css')?>">
    <script src="<?=asset('lib/layui/layui.js')?>" charset="utf-8"></script>

    <script src="<?=asset('js/x-layui.js')?>" charset="utf-8"></script>
    <script src="<?=asset('js/admin.js')?>"></script>

    <script src="<?=asset('js/information/myinfo_edit.js')?>"></script>

    <style>
        .layui-icon{
            color: black;
            font-size: 24px;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">个人空间</div>


                    <div class="card-body">
                        <?php if (isset($msg)) {
                            foreach ($msg as $value) { ?>
                            <p class="WarningMsg"><?= $value ?></p>
                        <?php }} ?>
                        <form method="post" action="">
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label>用户名</label>
                                <input type="text" class="form-control" name="name" value="<?=Auth::user()['name']?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>E-mail</label>
                                <input type="email" class="form-control" readonly value="<?=Auth::user()['email']?>">
                            </div>
                            <div class="form-group col-md-12 text-right">
                                <button class="btn btn-success col-md-2" type="submit">保存</button>
                            </div>

                        </div>
                        </form>

            </div>
        </div>
    </div>

<?php view('layouts/footer') ?>