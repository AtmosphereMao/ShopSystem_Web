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

    public static function query()
    {
        return parent::getModel()->select(self::TABLE);
    }
}