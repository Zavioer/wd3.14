<?php

session_start();

require 'Routing.php';
require_once 'src/middlewares/AuthMiddleware.php';
require_once 'src/middlewares/AuthorizationMiddleware.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('dashboard', 'DefaultController', [
    new AuthMiddleware()]);
Router::get('home', 'DefaultController', [
    new AuthMiddleware()]);

Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');
Router::post('logout', 'SecurityController', [new AuthMiddleware()]);


Router::get('users', 'UserController', [
    new AuthorizationMiddleware('USER_READ'), new AuthMiddleware()]);
Router::get('userDelete', 'UserController', [
    new AuthorizationMiddleware('USER_DELETE'), new AuthMiddleware()]);
Router::get('userModify', 'UserController', [
    new AuthorizationMiddleware('USER_MODIFY'), new AuthMiddleware()]);

Router::get('products', 'ProductController', [
    new AuthorizationMiddleware('PRODUCT_READ'), new AuthMiddleware()]);
Router::get('productDetail', 'ProductController', [
    new AuthorizationMiddleware('PRODUCT_READ'), new AuthMiddleware()]);
Router::post('productAdd', 'ProductController', [
    new AuthorizationMiddleware('PRODUCT_ADD'), new AuthMiddleware()]);

Router::get('clients', 'ClientController', [
    new AuthorizationMiddleware('CLIENT_READ'), new AuthMiddleware()]);
Router::get('clientAdd', 'ClientController', [
    new AuthorizationMiddleware('CLIENT_ADD'), new AuthMiddleware()]);

Router::run($path);