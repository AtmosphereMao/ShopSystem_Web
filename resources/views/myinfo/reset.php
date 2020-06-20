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

                            <div class="form-row text-center justify-content-center">
                                <div class="form-group col-md-8">
                                    <label>旧密码</label>
                                    <input id="password" type="password" class="form-control" name="password_old" placeholder="旧密码" required autofocus>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>新密码</label>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="新密码" required autofocus>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>确认密码</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="确认密码" required autofocus>
                                </div>
                                <div class="form-group col-md-12 text-center">
                                    <button type="submit" class="btn btn-success col-md-2">提交</button>
                                </div>
                            </div>

                        </form>

            </div>
        </div>
    </div>

<?php view('layouts/footer') ?>