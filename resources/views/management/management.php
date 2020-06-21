<?php view('layouts/header') ?>
    <link rel="stylesheet" href="<?=asset('lib/layui/css/layui.css')?>">

    <script src="<?=asset('lib/layer/layer.js')?>" charset="utf-8"></script>

    <script src="<?=asset('js/management.js')?>" charset="utf-8"></script>

    <style>
        .layui-icon{
            color: black;
            font-size: 24px;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="box card">
                    <div class="card-header">订单</div>
                    <?php $count = 1;
                      if(!empty($orders)) {
                        foreach ($orders as $value) { ?>
                    <div class="card-body">
                        <small class="text-muted text-right">Item: <?=$count?></small>
                        <?php $count+=1 ?>
                        <div class="trend_card col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
 
                                    <p class="card-text"><?=getTrends($value['trends_id'])['title']?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="trendShow(<?=getTrends($value['trends_id'])['page_id']?>)">View</button>
                                        </div>

                                        <small class="text-muted text-right">
                                            × <?=$value['quantity']?>
                                            <br>
                                            Unit Price: <?=getTrends($value['trends_id'])['price']?>
                                            <br>
                                            Finished: <?=$value['finished_quantity']?>
                                            <br>
                                            Status:
                                            <?php if ($value['status'] == 0 || $value['status'] == 2) { ?>
                                                未完成
                                            <?php } else if ($value['status'] == 1) { ?>
                                                已完成
                                            <?php } ?>
                                            <br>
                                            Buyer: <?=getUser(getTrends($value['trends_id'])['create_user'])?>
                                        </small>

                                    </div>
                                    <?php if ($value['status'] == 0 or 2) { ?>
                                    <div class="btn-group right" order_id="<?=$value['id']?>">
                                        <button type="button" class="orderComplete btn btn-sm btn-outline-secondary">Complete</button>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } else { ?>
                    <div class="card-body">
                        <el-card class="event_card">
                            <el-container>
                                <p class="lead">空的订单</p>
                            </el-container>
                        </el-card>
                    </div>
                    <?php } ?>


                </div>
            </div>
        </div>
    </div>

<?php view('layouts/footer') ?>