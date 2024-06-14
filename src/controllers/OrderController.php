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

        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $houseNumber = $_POST['house-number'];
        $postalCode = $_POST['postal-code'];
        $companyName = $_POST['company-name'] ?? '';
        $baseValidator = new ValidatorExecutor([
            new TextLengthValidator(3, 255)
        ]);

        $firstNameErrors = $baseValidator->run($firstName, 'First Name');
        $lastNameErrors = $baseValidator->run($lastName, 'Last Name');
        $cityErrors = $baseValidator->run($city, 'City');
        $streetErrors = $baseValidator->run($street, 'Street');
        
        $houseNumberValidator = new ValidatorExecutor([
            new TextLengthValidator(0, 10)
        ]);
        $houseNumberErrors = $houseNumberValidator->run($houseNumber, 'House Number');

        $postalCodeValidator = new ValidatorExecutor([
            new TextLengthValidator(0, 6)
        ]);
        $postalCodeErrors = $postalCodeValidator->run($postalCode, 'Postal Code');

        $errors = array_merge(
            $firstNameErrors,
            $lastNameErrors,
            $cityErrors,
            $streetErrors,
            $houseNumberErrors,
            $postalCodeErrors,
        );
        
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

        if (!empty($errors)) {
            $messages = [];
            foreach($errors as $errorText) {
                array_push($messages, new Message($errorText, Message::ERROR));
            }
            $products = $this->productRepository->getProducts();
            $clients = $this->clientRepository->getClients();
            return $this->render('order-add', [
                'products' => $products,
                'clients' => $clients,
                'messages' => $messages
            ]);
        }

        $client = $this->clientRepository->getOrAddClient($maybeNewClient);

        $amountValidator = new ValidatorExecutor([
            new NumberInRangeValidator(0)
        ]);
        $amountErrors = $amountValidator->run($amount, 'Amount');

        $discountValidator = new ValidatorExecutor([
            new NumberInRangeValidator(0, 1)
        ]);
        $discountErrors = $discountValidator->run($discount, 'Discount');

        $this->orderRepository->addOrderV2(
            $client->getId(),
            $_SESSION['user_id'],
            (int)$_POST['product'],
            $_POST['amount'],
            $_POST['discount']
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
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/orders");
    }
}