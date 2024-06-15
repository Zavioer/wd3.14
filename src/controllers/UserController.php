<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/UserRepository.php';
require_once __DIR__.'../../forms/UserForm.php';

class UserController extends AppController {
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function users($req) {
        $users = $this->userRepository->getUsers();
        $user = $req['user'];
        $this->render('salesman-list', [
            'users' => $users,
            'user' => $user,
            'messages' => $messages
        ]);
    }

    public function userDelete($req) {
        $id = $req['input'];
        $result = $this->userRepository->deleteUserById($id);

        if ($result !== null) {
            $this->redirect('internalServerError');
        }
        
        $this->redirect('users');
    }

    public function userModify($req) {
        $user = $req['user'];

        if (!$this->isPost()) {
            $id = $req['input'];
            $_SESSION['lastUserToModifyId'] = $id;
            $userToModify = $this->userRepository->getUserById($id);
            $roles = $this->userRepository->getUserAvailableRoles();
            return $this->render('salesman-modify', [
                'user' => $user, 
                'userToModify' => $userToModify, 
                'roles' => $roles
            ]);
        }

        $_POST['password'] = '';
        $userForm = new UserForm($_POST);
        if (!$userForm->validate()) {
            $messages = $this->createMessagesArray($userForm->getErrors(), Message::ERROR);
            $roles = $this->userRepository->getUserAvailableRoles();
            $userToModify = $this->userRepository->getUserById($_SESSION['lastUserToModifyId']);
            return $this->render('salesman-modify', [
                'roles' => $roles,
                'user' => $user,
                'userToModify' => $userToModify,
                'messages' => $messages
            ]);
        }
    
        $updatedUser = $userForm->getValidatedModel();
        $this->userRepository->updateUser($updatedUser);
        $this->redirect('users');
    }
}