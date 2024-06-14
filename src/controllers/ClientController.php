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

    public function clients($req) {
        $products = $this->clientRepository->getClients();
        $user = $req['user'];
        return $this->render('client-list', ['clients' => $products, 'user' => $user]);
    }

    public function clientDetail($req) {
        $id = $req['input'];
        
        if ($_GET['type'] === 'json') {
            $client = $this->clientRepository->getClientById($id, true);
            $this->jsonify($client);
        }

        $client = $this->clientRepository->getClientById($id);
        return $client;
    }

    public function clientDelete($req) {
        $id = $req['input'];
        $this->clientRepository->deleteClientById($id);
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/clients");
    }

    public function clientModify($req) {
        if (!$this->isPost()) {
            $id = $req['input'];
            $user = $req['user'];
            $client = $this->clientRepository->getClientById($id);
            $this->render('client-modify', ['client' => $client, 'user' => $user]);
        }

    }
}