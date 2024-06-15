<?php

session_start();

require 'Routing.php';
require_once 'src/middlewares/AuthMiddleware.php';
require_once 'src/middlewares/AuthorizationMiddleware.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('dashboard', 'DefaultController', [
    new AuthorizationMiddleware('ORDER_READ'), new AuthMiddleware()]);
Router::get('home', 'DefaultController', [
    new AuthorizationMiddleware('CLIENT_READ'), new AuthMiddleware()]);

Router::get('forbidden', 'DefaultController');
Router::get('unauthorized', 'DefaultController');
Router::get('notFound', 'DefaultController');
Router::get('internalServerError', 'DefaultController');

Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController', [
    new AuthorizationMiddleware('USER_ADD'), new AuthMiddleware()]);
Router::get('logout', 'SecurityController', [new AuthMiddleware()]);

Router::get('users', 'UserController', [
    new AuthorizationMiddleware('USER_READ'), new AuthMiddleware()]);
Router::get('userDelete', 'UserController', [
    new AuthorizationMiddleware('USER_DELETE'), new AuthMiddleware()]);
Router::post('userModify', 'UserController', [
    new AuthorizationMiddleware('USER_MODIFY'), new AuthMiddleware()]);

Router::get('products', 'ProductController', [
    new AuthorizationMiddleware('PRODUCT_READ'), new AuthMiddleware()]);
Router::get('productsMobile', 'ProductController', [
    new AuthorizationMiddleware('PRODUCT_READ'), new AuthMiddleware()]);
Router::get('productDetail', 'ProductController', [
    new AuthorizationMiddleware('PRODUCT_READ'), new AuthMiddleware()]);
Router::post('productAdd', 'ProductController', [
    new AuthorizationMiddleware('PRODUCT_ADD'), new AuthMiddleware()]);
Router::get('productDelete', 'ProductController', [
    new AuthorizationMiddleware('PRODUCT_DELETE'), new AuthMiddleware()]);
Router::post('productModify', 'ProductController', [
    new AuthorizationMiddleware('PRODUCT_MODIFY'), new AuthMiddleware()]);

Router::get('clients', 'ClientController', [
    new AuthorizationMiddleware('CLIENT_READ'), new AuthMiddleware()]);
Router::post('clientAdd', 'ClientController', [
    new AuthorizationMiddleware('CLIENT_ADD'), new AuthMiddleware()]);
Router::post('clientModify', 'ClientController', [
    new AuthorizationMiddleware('CLIENT_MODIFY'), new AuthMiddleware()]);
Router::get('clientDelete', 'ClientController', [
    new AuthorizationMiddleware('CLIENT_DELETE'), new AuthMiddleware()]);
Router::get('clientDetail', 'ClientController', [
    new AuthorizationMiddleware('CLIENT_READ'), new AuthMiddleware()]);

Router::get('orders', 'OrderController', [
    new AuthorizationMiddleware('ORDER_READ'), new AuthMiddleware()]);
Router::post('orderAdd', 'OrderController', [
    new AuthorizationMiddleware('ORDER_ADD'), new AuthMiddleware()]);
Router::get('orderResolve', 'OrderController', [
    new AuthorizationMiddleware('ORDER_MODIFY'), new AuthMiddleware()]);

Router::get('ordersCountByProductType', 'ReportController', [
    new AuthorizationMiddleware('ORDER_READ'), new AuthMiddleware()]);
Router::get('monthlyIncome', 'ReportController', [
    new AuthorizationMiddleware('ORDER_READ'), new AuthMiddleware()]);

Router::run($path);