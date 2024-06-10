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
        $this->render('login');
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
}