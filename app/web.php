<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 21:43
 */

use core\Router;

Router::GET('/', 'HomeController/index');

/* Auth */
Router::GET('/login', 'LoginController/index');
Router::POST('/login', 'LoginController/login');
Router::GET('/register', 'RegisterController/index');
Router::POST('/register', 'RegisterController/register');
Router::POST('/logout', 'LoginController/logout');


/* Trends */