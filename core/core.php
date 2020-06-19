<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 17:31
 */

require_once('../core/helper.php');
require_once('../support/env.php');
require_once('../core/config.php');

if (env('APP_DEBUG', 'true'))
{
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

