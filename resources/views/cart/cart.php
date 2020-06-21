<?php view('layouts/header') ?>
    <link rel="stylesheet" href="<?=asset('lib/layui/css/layui.css')?>">

    <script src="<?=asset('lib/layer/layer.js')?>" charset="utf-8"></script>

    <script src="<?=asset('js/cart.js')?>" charset="utf-8"></script>


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
                    <div class="card-header">购物车</div>
                    <?php if(count($trends)==0) { ?>
                    <div class="card-body">
                        <el-card class="event_card">
                            <el-container>
                                <p class="lead">空的购物车</p>
                            </el-container>
                        </el-card>
                    </div>
                    <?php } else {
                        $price_sum = 0;$quantity_sum = 0;
                        for($count=0;$count<count($trends);$count++) {
                        $price_sum+=($trends[$count]['price'] * $cart[$count]['quantity']);
                        $quantity_sum+=$cart[$count]['quantity']; ?>
                    <div class="card-body">
                        <small class="text-muted text-right">Item. <?=$count+1?></small>
                        <div class="trend_card col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <a title="删除" href="javascript:;" onclick="cart_del(this,<?=$cart[$count]['id']?>)"
                                       style="text-decoration:none;float: right;">
                                        <i class="layui-icon" >&#x1006;</i>
                                    </a>
                                    <p class="card-text"><?=$trends[$count]['title']?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="trendShow(<?=$trends[$count]['page_id']?>)">View</button>
                                        </div>

                                        <small class="text-muted text-right" style="font-size: 20px;">
                                            × <?=$cart[$count]['quantity']?>
                                            <br>
                                            Price: <?=$trends[$count]['price'] * $cart[$count]['quantity']?>
                                        </small>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                    <small class="text-muted text-right m-4" style="font-size: 20px;">
                        商品总数 : <?=$quantity_sum?>
                        <br>
                        总价 : <?=$price_sum?>
                    </small>
                    <div class="form-group col-md-12 text-right">
                        <button class="btn btn-warning col-md-2" onclick="cartSumbit()">结账</button>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

<?php view('layouts/footer') ?>