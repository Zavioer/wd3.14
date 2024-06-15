<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/ProductRepository.php';
require_once __DIR__.'../../repository/ClientRepository.php';

class DefaultController extends AppController {
    private $productRepository;
    private $clientRepository;

    public function __construct()
    {
        parent::__construct();
        $this->productRepository = new ProductRepository();
        $this->clientRepository = new ClientRepository();
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

    public function home($req) {
        $user = $req['user'];
        $clients = $this->clientRepository->getClientsForSalesman($user->getId());
        $this->render('home', ['clients' => $clients]);
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

    public function internalServerError() {
        http_response_code(500);
        $this->render('/errors/500');
    }
}