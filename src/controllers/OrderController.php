<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/OrderRepository.php';

class OrderController extends AppController {
    private $orderRepository;

    public function __construct()
    {
        parent::__construct();
        $this->orderRepository = new OrderRepository();
    }
        
    public function addOrder() {
        if (!$this->isPost()) {
            return $this->render('order-add');
        }

        $product = $_POST['product'];
        $amount = $_POST['amount'];
        $discount = $_POST['discount'];

        // TODO fix with correct data
        $product = new Order(
        );

        $this->productRepository->addOrder($order);

        return $this->render('order-add', ['messages' => ['Product succesfully added']]);
    }

    public function orders() {
        $orders = $this->orderRepository->getOrders();
        return $this->render('order-list', ['orders' => $orders]);
    }

    public function orderDetail(int $id) {
        $order = $this->orderRepository->getOrderBy($id);
        return $this->render('order-detail', ['order' => $order]);
    }
}