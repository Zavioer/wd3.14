<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/OrderRepository.php';
require_once __DIR__.'../../repository/ProductRepository.php';
require_once __DIR__.'../../repository/ClientRepository.php';

class OrderController extends AppController {
    private $orderRepository;

    public function __construct()
    {
        parent::__construct();
        $this->orderRepository = new OrderRepository();
        $this->productRepository = new ProductRepository();
        $this->clientRepository = new ClientRepository();
    }
        
    public function orderAdd() {
        if (!$this->isPost()) {
            $products = $this->productRepository->getProducts();
            $clients = $this->clientRepository->getClients();
            return $this->render('order-add', ['products' => $products, 'clients' => $clients]);
        }

        $product = $_POST['product'];
        $amount = $_POST['amount'];
        $discount = $_POST['discount'];
        
        $maybeNewClient = new Client(
            $_POST['first-name'],
            $_POST['last-name'],
            $_POST['city'],
            $_POST['street'],
            $_POST['house-number'],
            $_POST['postal-code'],
            $_POST['company-name'] ?? '',
            0
        );
        $client = $this->clientRepository->getOrAddClient($maybeNewClient);

        $this->orderRepository->addOrderV2(
            $client->getId(),
            $_SESSION['user_id'],
            (int)$_POST['product'],
            $_POST['amount'],
            $_POST['discount']
        );

        $products = $this->productRepository->getProducts();
        $clients = $this->clientRepository->getClients();
        return $this->render('order-add', [
            'messages' => ['Product succesfully added'],
            'products' => $products,
            'clients' => $clients
        ]);
    }

    public function orders($req) {
        $orders = $this->orderRepository->getOrdersDetailed();
        $user = $req['user'];
        return $this->render('order-list', ['orders' => $orders, 'user' => $user]);
    }

    public function orderDetail(int $id) {
        $order = $this->orderRepository->getOrderBy($id);
        return $this->render('order-detail', ['order' => $order]);
    }

    public function orderResolve($req) {
        $orderId = $req['input'];
        $this->orderRepository->resolveOrder($orderId);
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/orders");
    }
}