<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/20
 * Time: 19:34
 */

namespace App\Http\Model;

use core\Model;

class Users extends Model
{
    const TABLE = 'users';

    public function __construct()
    {
    }

    public static function create($data)
    {
        return parent::getModel()->insert(self::TABLE, $data);
    }

    public static function query()
    {
        return parent::getModel()->select(self::TABLE);
    }

    public static function update($data, $query, $queryData)
    {
        return parent::getModel()->update(self::TABLE, $data)->where($query, $queryData)->end();
    }
}