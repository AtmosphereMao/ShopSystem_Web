<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/20
 * Time: 19:34
 */

namespace App\Http\Model;

use core\Model;

class Trends extends Model
{
    const TABLE = 'trends_content';

    public function __construct()
    {
    }

    public static function query()
    {
        return parent::getModel()->select(self::TABLE);
    }

    public static function create($data)
    {
        return parent::getModel()->insert(self::TABLE, $data);
    }

    public static function update($data, $query, $queryData)
    {
        return parent::getModel()->update(self::TABLE, $data)->where($query, $queryData)->end();
    }

    public static function delete($query, $data)
    {
        return parent::getModel()->delete(self::TABLE)->where($query, $data)->end();
    }
}