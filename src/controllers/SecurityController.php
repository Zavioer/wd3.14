<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/UserRepository.php';

class SecurityController extends AppController {
    
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        if (!$this->isPost()) {
            return $this->render('login-desktop');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUserByEmail($email);

        if (!$user) {
            return $this->render('login-desktop', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login-desktop', ['messages' => ['User with this email not exist!']]);
        }
        
        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login-desktop', ['messages' => ['Wrong password!']]);
        }

        $this->userRepository->registerLoginSession($user);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/dashboard");
    }

    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('salesman-add-d');
        }

        $email = $_POST['email'];
        $password = 'asdf'; // TODO auto generated password for 1st login
        $confirmedPassword = 'asdf'; //
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $licenceCode = $_POST['licence-code'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $houseNumber = $_POST['house-number'];
        $postalCode = $_POST['postal-code'];

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Please provide proper password']]);
        }

        $user = new User(
            $email, 
            password_hash($password, PASSWORD_DEFAULT), 
            $firstName, 
            $lastName,
            $licenceCode,
            $city,
            $street,
            $houseNumber,
            $postalCode,
            2 //TODO temporary salesman role id
        );

        $this->userRepository->addUser($user);

        return $this->render('login-desktop', ['messages' => ['You\'ve been succesfully registrated!']]);
    }

    public function logout()
    {
        $this->userRepository->logout();
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }
}