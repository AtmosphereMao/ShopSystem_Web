<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 22:01
 */

namespace handler;

use core\Database;

class Handler
{
    protected $DB;
    protected $check;

    public function __construct()
    {
        $this->DB = new Database();
    }

    public function show($path, $var = array())
    {
        if (!file_exists('../views/' . $path)) {
            return;
        }

        extract($var);
        require_once('../core/function.php');
        include('../views/' . $path);
    }

    public function redirect($dist)
    {
        header('Location: ' . $dist);
        exit;
    }

    public function GET($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }
        return '';
    }

    public function POST($key)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }
        return '';
    }

}