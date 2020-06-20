<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 21:43
 */

use core\Router;

Router::GET('/', 'HomeController/index');
Router::GET('/home', 'HomeController/home');

/* Auth */
Router::GET('/login', 'LoginController/index');
Router::POST('/login', 'LoginController/login');
Router::GET('/register', 'RegisterController/index');
Router::POST('/register', 'RegisterController/register');
Router::POST('/logout', 'LoginController/logout');

/* MyInfo */
Router::GET('/myInfo', 'MyInfoController/index');
Router::GET('/myInfo/edit', 'MyInfoController/edit');
Router::POST('/myInfo/edit', 'MyInfoController/save');

Router::GET('/myInfo/password/reset', 'MyInfoController/reset');
Router::POST('/myInfo/password/reset', 'MyInfoController/resetPassword');
/* Trends */