<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/20
 * Time: 16:03
 */

namespace core;

use handler\Handler;

class Model extends Handler
{
    private $db;
    public function __construct($table)
    {
        parent::__construct();
        $this->db = $this->DB->select($table);
    }

    public static function getModel()
    {
        return parent::getDB();
    }
}