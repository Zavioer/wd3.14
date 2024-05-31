<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/ClientRepository.php';

class ClientController extends AppController {
    private $clientRepository;

    public function __construct()
    {
        parent::__construct();
        $this->clientRepository = new ClientRepository();
    }
        
    public function addClient() {
        if (!$this->isPost()) {
            return $this->render('client-add-d');
        }

        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $houseNumber = $_POST['house-number'];
        $postalCode = $_POST['postal-code'];
        $companyName = $_POST['company-name'] ?? '';

        $client = new Client(
            $firstName,
            $lastName,
            $city,
            $street,
            $houseNumber,
            $postalCode,
            $companyName,
            0 // temporary id not used in insert
        );
        $this->clientRepository->addClient($client);

        return $this->render('client-add-d', ['messages' => ['Client succesfully added']]);
    }

    public function clients() {
        $products = $this->clientRepository->getClients();
        return $this->render('client-list', ['clients' => $products]);
    }

}