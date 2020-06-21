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

/* MyInfo */
Router::GET('/myInfo', 'MyInfoController/index');
Router::GET('/myInfo/edit', 'MyInfoController/edit');
Router::POST('/myInfo/edit', 'MyInfoController/save');

Router::GET('/myInfo/password/reset', 'MyInfoController/reset');
Router::POST('/myInfo/password/reset', 'MyInfoController/resetPassword');

/* Trends */
Router::GET('/home', 'HomeController/home');
Router::GET('/home/trends/page', 'HomeController/trendShow');
Router::POST('/home/trends/buy', 'HomeController/trendBuy');

/* Cart */
Router::GET('/cart', 'CartController/index');
Router::DELETE('/cart/delete', 'CartController/cartDelete');
Router::POST('/cart/submit', 'CartController/cartSubmit');

/* Order */
Router::GET('/order', 'OrderController/index');

/* Management */
Router::GET('/management', 'ManagementController/index');
Router::POST('/management/complete', 'ManagementController/orderComplete');



