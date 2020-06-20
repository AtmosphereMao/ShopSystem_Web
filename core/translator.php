<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/20
 * Time: 12:15
 */

namespace core;


class Translator
{
    private static $langPath = "../resources/lang/";

    public static function trans()
    {
        if($_SERVER['HTTP_ACCEPT_LANGUAGE']=="zh-cn") $lang = "zh-CN";
        elseif($_SERVER['HTTP_ACCEPT_LANGUAGE']=="en") $lang = "en";
        elseif($_SERVER['HTTP_ACCEPT_LANGUAGE']=="zh-TW") $lang = "zh-TW";
        else $lang = "zh-CN";
        return include static::$langPath . $lang . '/admin.php';
    }
}