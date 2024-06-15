<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/OrderRepository.php';
require_once __DIR__.'../../repository/ProductRepository.php';
require_once __DIR__.'../../repository/ClientRepository.php';
require_once __DIR__.'../../forms/ClientForm.php';
require_once __DIR__.'../../forms/OrderForm.php';

class OrderController extends AppController {
    private $orderRepository;
    private $productRepository;
    private $clientRepository;

    public function __construct()
    {
        parent::__construct();
        $this->orderRepository = new OrderRepository();
        $this->productRepository = new ProductRepository();
        $this->clientRepository = new ClientRepository();
    }
        
    public function orderAdd($req) {
        $user = $req['user'];
        if (!$this->isPost()) {
            $products = $this->productRepository->getProducts();
            $clients = $this->clientRepository->getClients();
            return $this->render('order-add', ['products' => $products, 'clients' => $clients]);
        }

        $clientForm = new ClientForm($_POST); 
        if (!$clientForm->validate()) {
            $messages = $this->createMessagesArray($clientForm->getErrors(), Message::ERROR);
            $products = $this->productRepository->getProducts();
            $clients = $this->clientRepository->getClients();
            return $this->render('order-add', [
                'products' => $products,
                'clients' => $clients,
                'messages' => $messages
            ]);
        }
        $maybeNewClient = $clientForm->getValidatedModel();
        $client = $this->clientRepository->getOrAddClient($maybeNewClient);

        $orderForm = new OrderForm($_POST); 
        if (!$orderForm->validate()) {
            $messages = $this->createMessagesArray($orderForm->getErrors(), Message::ERROR);
            $products = $this->productRepository->getProducts();
            $clients = $this->clientRepository->getClients();
            return $this->render('order-add', [
                'products' => $products,
                'clients' => $clients,
                'messages' => $messages
            ]);
        }

        $product = $_POST['product'];
        $amount = $_POST['amount'];
        $discount = $_POST['discount'];

        $this->orderRepository->addOrder(
            $client->getId(),
            $user->getId(),
            (int)$product,
            $amount,
            $discount
        );

        $products = $this->productRepository->getProducts();
        $clients = $this->clientRepository->getClients();
        $messages = [new Message('Order succesfully added!', Message::SUCCESS)];
        return $this->render('order-add', [
            'messages' => $messages,
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
        $this->redirect('orders');
    }
}