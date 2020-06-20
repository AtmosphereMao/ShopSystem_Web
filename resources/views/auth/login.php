<?php view('layouts/header') ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">登陆 Login</div>
                    <div class="card-body text-left">
                        <?php if(!empty($errors)) { ?>
                        <span class="help-block">
                            <?php foreach ($errors as $value) { ?>
                                    <strong><?= $value ?></strong><br>
                            <?php } ?>
                        </span>
                        <?php } ?>
                        <form class="form-signin" method="POST" action="<?= asset('login') ?>">
                            <h1 class="h3 mb-3 font-weight-normal">登陆 Login</h1>

                            <div class="form-group">
                                <label for="email" class="sr-only">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="" placeholder="邮箱" required>
                            </div>


                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>

                                <input id="password" type="password" class="form-control" name="password" placeholder="密码" required>
                            </div>
                            <center>
                                <div class="form-group w-75">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                                        <?= __('登录') ?>
                                    </button>

                                </div>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php view('layouts/footer') ?>