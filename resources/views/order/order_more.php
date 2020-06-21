<?php $count = ($count-1)*6+1;
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
                                Order ID: <?=$value['id']?>
                                <br>
                                Unit Price: <?=getTrends($value['trends_id'])['price']?>
                                <br>
                                Surplus: <?=$value['quantity'] - $value['finished_quantity']?>
                                <br>
                                Status:
                                <?php if($value['status'] == 0 or 2) {?>
                                    未完成
                                <?php } elseif($value['status'] == 1) {?>
                                    已完成
                                <?php } ?>
                                <br>
                                Seller: <?=getUser(getTrends($value['trends_id'])['create_user'])?>
                            </small>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } } else { ?>
<?php } ?>