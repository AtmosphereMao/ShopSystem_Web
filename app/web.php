<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 21:43
 */

use core\Router;

Router::GET('/', 'HomeController@index');
Router::GET('/add', 'Main@add');
Router::POST('/add', 'Main@addAction');
Router::GET('/edit', 'Main@edit');
Router::POST('/edit', 'Main@editAction');
Router::GET('/delete', 'Main@delete');
Router::POST('/delete', 'Main@deleteAction');