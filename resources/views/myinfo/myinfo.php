<?php view('layouts/header') ?>
    <link rel="stylesheet" href="<?=asset('lib/layui/css/layui.css')?>">
    <script src="<?=asset('lib/layui/layui.js')?>" charset="utf-8"></script>

    <script src="<?=asset('js/x-layui.js')?>" charset="utf-8"></script>
    <script src="<?=asset('js/admin.js')?>"></script>

    <script src="<?=asset('js/Information/myinfo.js')?>"></script>

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
                        <?php if (isset($msg)) {?>
                            <p class="WarningMsg"><?=$msg?></p>
                        <?php } ?>
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label>用户名</label>
                                <input type="text" class="form-control" readonly value="<?=Auth::user()['name']?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>E-mail</label>
                                <input type="email" class="form-control" readonly value="<?=Auth::user()['email']?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>账号注册时间</label>
                                <input type="email" class="form-control" readonly value="<?=Auth::user()['created_at']?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>账号余额</label>
                                <input type="email" class="form-control" readonly value="<?=Auth::user()['balance'] ?>">
                            </div>
                            <div class="form-group col-md-12 text-right">
                                <button class="btn btn-primary col-md-2" onclick="onTransition('<?=asset('myInfo/edit/')?>')">编辑</button>
                            </div>

                        </div>


                        <div class="card">
                            <div class="card-header">我的动态</div>
                            <div class="card-body text-center">

                                <xblock><button class="btn btn-danger right m-1" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
                                    <div class="text-left m-2">
                                        <input style="margin-right: 1%" type="checkbox" name="" id="all" value="全选"><label style="font-weight: bolder">全选</label>
                                    </div>
                                </xblock>
                                <?php if (!empty($trends)) { ?>
                                    <?php foreach ($trends as $value) { ?>
                                        <div class="form-group col-md-12 left text-left border-bottom p-2">

                                            <input type="checkbox" value="<?=$value->id?>"  name="checkbox">
                                            <span class="text-left w-100"><?=$value->title?></span>
                                            <span class="right"><?=substr($value->create_time,0,10)?></span>
                                            <div class="right mr-2">
                                                <a title="编辑" href="javascript:;" onclick="question_edit('编辑','<?=url("myTrends/edit/".$value->page_id)?>','4')"
                                                class="ml-5" style="text-decoration:none">
                                                <i class="layui-icon">&#xe642;</i>
                                                </a>
                                                <a title="删除" href="javascript:;" onclick="question_del(this,'<?=$value->id?>')"
                                                   style="text-decoration:none">
                                                    <i class="layui-icon">&#xe640;</i>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                <div class="text-center">
                                    暂无数据
                                </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-12 text-right">
                                <button class="btn btn-primary col-md-2" onclick="onTransition('<?=asset('myTrends/publish')?>')">发布动态</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php view('layouts/footer') ?>