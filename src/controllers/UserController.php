<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/UserRepository.php';

class UserController extends AppController {
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function user() {
        $users = $this->userRepository->getUsersByRole('salesman');
        $this->render('salesman-list-d', ['users' => $users]);
    }

    public function userDelete($id) {
        $this->userRepository->deleteUserById($id);
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/user");
    }
}