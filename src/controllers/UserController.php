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

    public function users() {
        $users = $this->userRepository->getUsersByRole('salesman');
        $this->render('salesman-list', ['users' => $users]);
    }

    public function userDelete($req) {
        $id = $req['input'];
        $this->userRepository->deleteUserById($id);
        $messages = ['correct'];
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/users");
    }

    public function userModify($req) {
        if ($this->isPost()) {
            $updatedUser = new User(
                $_POST['email'],
                '',
                $_POST['first-name'],
                $_POST['last-name'],
                $_POST['license-code'],
                $_POST['city'],
                $_POST['street'],
                $_POST['house-number'],
                $_POST['postal-code'],
                $_POST['role'],
                $_POST['id']
            );

            $this->userRepository->updateUser($updatedUser);
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/users");
        } 

        $id = $req['input'];
        $user = $this->userRepository->getUserById($id);
        $roles = $this->userRepository->getUserAvailableRoles();
        $this->render('salesman-modify', ['user' => $user, 'roles' => $roles]);
    }
}