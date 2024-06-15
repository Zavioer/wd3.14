<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/ClientRepository.php';
require_once __DIR__.'../../forms/ClientForm.php';

class ClientController extends AppController {
    private $clientRepository;

    public function __construct()
    {
        parent::__construct();
        $this->clientRepository = new ClientRepository();
    }

    public function clients($req) {
        $products = $this->clientRepository->getClients();
        $user = $req['user'];
        return $this->render('client-list', ['clients' => $products, 'user' => $user]);
    }

    public function clientDetail($req) {
        $id = $req['input'];
        $client = $this->clientRepository->getClientById($id);
        
        if ($_GET['type'] === 'json') {
            $this->jsonify($client);
        }

        return $client;
    }

    public function clientDelete($req) {
        $id = $req['input'];
        $result = $this->clientRepository->deleteClientById($id);

        if ($result !== null) {
            $this->redirect('internalServerError');
        }

        $this->redirect('clients');        
    }

    public function clientModify($req) {
        $user = $req['user'];

        if (!$this->isPost()) {
            $id = $req['input'];
            $_SESSION['lastClientId'] = $id;
            $client = $this->clientRepository->getClientById($id);
            return $this->render('client-modify', ['client' => $client, 'user' => $user]);
        }

        $clientForm = new ClientForm($_POST);
        if (!$clientForm->validate()) {
            $messages = $this->createMessagesArray($clientForm->getErrors(), Message::ERROR);
            $client = $this->clientRepository->getClientById($_SESSION['lastClientId']);
            return $this->render('client-modify', [
                'messages' => $messages,
                'client' => $client,
                'user' => $user
            ]);
        }

        $updatedClient = $clientForm->getValidatedModel();
        $result = $this->clientRepository->updateClient($updatedClient);
        $this->redirect('clients');
    }
}