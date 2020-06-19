<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 17:31
 */

namespace core;

/* Config */
require_once('../support/env.php');
require_once('config.php');
require_once('helper.php');

if (env('APP_DEBUG', 'true'))
{
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

/* DataBase */
require_once('database.php');

/* Router */
require_once('router.php');

/* Route */
require_once('../app/web.php');

/* init Router */
new Router();

