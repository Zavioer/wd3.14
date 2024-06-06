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
            if (!is_null($_SESSION['user_id'])) {
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/dashboard");
            }

            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUserByEmail($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }
        
        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }
        
        if (session_status() == PHP_SESSION_ACTIVE) {
            $this->userRepository->registerLoginSession($user, session_id());
            $_SESSION['user_id'] = $user->getId();
        } else {
            return $this->render('login', ['messages' => ['Internal server error when login!']]);
        }


        $url = "http://$_SERVER[HTTP_HOST]";
        if ($user->getRole()->getName() !== 'salesman') {
            header("Location: {$url}/dashboard");
        } else {
            header("Location: {$url}/home");
        }
    }

    public function register()
    {
        if (!$this->isPost()) {
            $roles = $this->userRepository->getUserAvailableRoles();
            return $this->render('salesman-add', ['roles' => $roles]);
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
        $roleId = $_POST['role'];

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
            $roleId,
            0 // Not important here
        );

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }

    public function logout()
    {
        $this->userRepository->deleteUserSession(session_id());
        $_SESSION = [];
        session_regenerate_id(true);
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }
}