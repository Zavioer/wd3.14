<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/ProductRepository.php';

class DefaultController extends AppController {
    private $productRepository;

    public function __construct()
    {
        parent::__construct();
        $this->productRepository = new ProductRepository();
    }

    public function index() {
        $this->redirect('login');
    }

    public function dashboard($req) {
        $user = $req['user'];
        $products = $this->productRepository->getProducts();
        $products = array_slice($products, 0, 3);
        $this->render('dashboard', ['user' => $user, 'products' => $products]);
    }

    public function home() {
        $this->render('home');
    }

    public function forbidden() {
        $this->render('errors/403');
    }

    public function unauthorized() {
        $this->render('errors/401');
    }

    public function notFound() {
        $this->render('/errors/404');
    }
}