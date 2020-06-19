<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 20:42
 */

use support\Env;

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        return Env::get($key) ? Env::get($key) : $default;
    }
}