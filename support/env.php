<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 19:06
 */

namespace support;

use core\Config;

class Env
{
    protected static $path = '../.env';



    public static function memCache()
    {
        $memcache = new \Memcached;
        $memcache->addServer(Config::get('MEMCACHE_URL'), Config::get('MEMCACHE_PORT')) or die ("Could not connect");
        return $memcache;
    }

    public static function setVariables($key, $memCache = null)
    {
        try{
            $handle = fopen(static::$path, 'r') or die("Unable to open file!");;
            $contents = fread($handle, filesize(static::$path));
            $contentList = preg_split("/[\n,]+/", $contents);
            $valueList = [];
            if ($memCache === null) $memCache = static::memCache();

            foreach ($contentList as $item => $value) {
                if (strlen($value) !== 1 or 0) {
                    $temp = preg_split('/[=,]+/', $value);
                    $valueList[$temp[0]] = substr($temp[1],0,strlen($temp[1])-1);
                    $memCache->set($temp[0], $valueList[$temp[0]]);
                }
            }
            fclose($handle);
        }catch (\Exception $e){
            throw new \Exception('配置文件错误');
        }
        return $memCache->get($key);
    }

    public static function get($key)
    {
        $memCache = static::memCache();
        return $memCache->get($key) ? $memCache->get($key) : static::setVariables($key, $memCache);
    }
}