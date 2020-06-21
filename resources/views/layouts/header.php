<!DOCTYPE html>
<!-- saved from url=(0050)https://v4.bootcss.com/docs/4.0/examples/carousel/ -->
<html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="">

    <link rel="icon" href="<?=asset('favicon.ico')?>">

    <title><?=env('APP_NAME')?></title>
    <!-- Bootstrap core CSS -->
    <link href="<?=asset('css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=asset('css/carousel.css')?>" rel="stylesheet">

    <link href="<?=asset('css/custom.css?version=1.1.0')?>" rel="stylesheet" type="text/css">
    <script src="<?=asset('js/jquery.min.js')?>"></script>
    <script src="<?=asset('js/main.js')?>"></script>
    <script src="<?=asset('lib/layer/layer.js')?>" charset="utf-8"></script>
    <script src="<?=asset('js/home.js')?>" charset="utf-8"></script>


</head>
<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="<?=asset('/')?>"><?= env('APP_NAME') ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?=asset('')?>">Index<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=asset('home')?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=asset('cart')?>">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=asset('order')?>">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=asset('management')?>">Management</a>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
<!--                --><?php if(auth()){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= asset('login') ?>"><?= k('login') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= asset('register') ?>"><?= k('register') ?></a>
                </li>
                <?php }else{ ?>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?= Auth::user()['name'] ?> <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?=asset("myTrends/publish")?>">
                        发布商品
                        </a>
                        <a class="dropdown-item" href="<?=asset("myInfo")?>">
                        个人空间
                        </a>
                        <a class="dropdown-item" href="<?=asset("myInfo/password/reset")?>">
                        修改密码
                        </a>
                        <a class="dropdown-item" href="<?= asset('logout') ?>"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            退出
                        </a>

                        <form id="logout-form" action="<?= asset('logout') ?>" method="POST" style="display: none;">
                        </form>


                    </div>
                </li>
                <?php } ?>
            </ul>

            <form class="form-inline mt-2 mt-md-0" action="<?=asset('home')?>" method="get">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</header>

<main role="main">