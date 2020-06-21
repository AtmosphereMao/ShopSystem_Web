<?php view('layouts/header') ?>

    <main role="main">

        <section class="jumbotron text-left">
            <div class="container">
                <h1 class="jumbotron-heading">Shop</h1>
                <p class="lead text-left">商店系统</p>
                <p>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row box">
                    <?php if (!empty($trends)) { ?>
                        <?php foreach ($trends as $value) { ?>
                        <div class="trend_card col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="225">
                                    <title><?=$value['title']?></title>
                                    <rect width="100%" height="100%" fill="#55595c"></rect>
                                    <text x="25%" y="50%" fill="#eceeef" dy=".3em"><?=$value['title']?></text>
                                </svg>
                                <div class="card-body">
                                    <p class="card-text"><?=$value['backbone']?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group" trend_id="<?=$value['id']?>">`
                                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="trendShow(<?=$value['page_id']?>)">View</button>
                                            <button type="button" class="trend_buy btn btn-sm btn-outline-secondary">Buy</button>
                                        </div>
                                        <small class="text-muted text-right"><?=substr($value['created_at'],0,16)?><br><?=getUser($value['create_user'])?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    <?php } else { ?>
                    <el-card class="event_card">
                        <el-container>
                            <p class="lead">暂无数据</p>
                        </el-container>
                    </el-card>
                    <?php } ?>
                </div>
            </div>
        </div>

    </main>

<?php view('layouts/footer') ?>