<?php

session_start();

require 'Routing.php';
require_once 'src/middlewares/AuthMiddleware.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('dashboard', 'DefaultController');
Router::get('user', 'UserController', [new AuthMiddleware()]);
Router::get('userDelete', 'UserController', [new AuthMiddleware()]);
Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');
Router::post('logout', 'SecurityController', [new AuthMiddleware()]);

Router::run($path);