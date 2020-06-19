<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 19:56
 */
namespace core;

class Config
{
    private static $config = [
        'MEMCACHE_URL' => 'localhost',
        'MEMCACHE_PORT' => '11211'
    ];
    public static function getList()
    {
        return [
            'APP_NAME' => env('APP_NAME','LaraMao'),
            'APP_ENV' => env('APP_ENV','production'),
            'APP_DEBUG' => env('APP_DEBUG','true'),
            'APP_URL' => env('APP_URL','http://localhost'),

            'DB_HOST' => env('DB_HOST', 'localhost'),
            'DB_PORT' => env('DB_HOST', 'localhost'),
            'DB_USERNAME' => env('DB_USER', 'root'),
            'DB_PASSWORD' => env('DB_PASSWORD', 'root'),
            'DB_DATABASE' => env('DB_NAME', 'database')
        ];
    }
    public static function get($key)
    {
        return static::$config[$key];
    }
}