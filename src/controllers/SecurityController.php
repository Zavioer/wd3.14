<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/UserRepository.php';
require_once __DIR__.'../../models/Role.php';
require_once __DIR__.'../../forms/UserForm.php';

class SecurityController extends AppController {
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    private function redirectToWebOrMobile($user)
    {
        if ($user->getRole()->getName() !== Role::SALESMAN) {
            $this->redirect('dashboard');
        } else {
            $this->redirect('home');
        }
    }

    private function generateTemporaryPassword($length = 8)
    {
        $upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowerCase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $specialChars = '!@#$%^&*()_+{}|:<>?[];,./`~';

        // Combine all character sets
        $allChars = $upperCase . $lowerCase . $numbers . $specialChars;

        // Ensure password includes at least one character from each set
        $password = $upperCase[random_int(0, strlen($upperCase) - 1)];
        $password .= $lowerCase[random_int(0, strlen($lowerCase) - 1)];
        $password .= $numbers[random_int(0, strlen($numbers) - 1)];
        $password .= $specialChars[random_int(0, strlen($specialChars) - 1)];

        // Fill the remaining length of the password with random characters from all sets
        for ($i = 4; $i < $length; $i++) {
            $password .= $allChars[random_int(0, strlen($allChars) - 1)];
        }

        $password = str_shuffle($password);
        return $password;
    }

    private function saveTmpPasswordToFile($password)
    {
        # Temporary function for demo purpose
        # TODO: send password to mail instead of temporary save to file
        file_put_contents(__DIR__.'/../../data/tmp_password.txt', $password);
    }

    public function login($req)
    {
        if (!$this->isPost()) {
            if (!is_null($_SESSION['user_id'])) {
                $user = $this->userRepository->getUserById($_SESSION['user_id']); 
                $this->redirectToWebOrMobile($user);
            }
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $this->userRepository->getUserByEmail($email);

        if (!$user) {
            $messages = [new Message('User not found!', Message::ERROR)];
            return $this->render('login', ['messages' => $messages]);
        }
        
        if (!password_verify($password, $user->getPassword())) {
            $messages = [new Message('Wrong password!', Message::ERROR)];
            return $this->render('login', ['messages' => $messages]);
        }
        
        if (session_status() == PHP_SESSION_ACTIVE) {
            $this->userRepository->registerLoginSession($user, session_id());
            $_SESSION['user_id'] = $user->getId();
        } else {
            $messages = [new Message('Internal server error!', Message::ERROR)];
            return $this->render('login', ['messages' => $messages]);
        }
        
        $this->redirectToWebOrMobile($user);
    }

    public function register($req)
    {
        if (!$this->isPost()) {
            $roles = $this->userRepository->getUserAvailableRoles();
            $user = $req['user'];
            return $this->render('salesman-add', ['roles' => $roles, 'user' => $user]);
        }

        $_POST['password'] = $this->generateTemporaryPassword(); 
        $userForm = new UserForm($_POST);

        if (!$userForm->validate()) {
            $messages = $this->createMessagesArray($userForm->getErrors(), Message::ERROR);
            $roles = $this->userRepository->getUserAvailableRoles();
            $user = $req['user'];
            return $this->render('salesman-add', [
                'roles' => $roles,
                'user' => $user,
                'messages' => $messages
            ]);
        }

        $newUser = $userForm->getValidatedModel();
        $result = $this->userRepository->addUser($newUser);
        if ($result === null) {
            $this->saveTmpPasswordToFile($_POST['password']);
            $this->redirect('users');
        } else {
            if ($result->getCode() == 23505) {
                $messages = [new Message('User with given name or licence code already exists!', Message::ERROR)];
            } else {
                $messages = [new Message("Server Error when adding Product $e->getMessage()!", Message::ERROR)];
            }

            $user = $req['user'];
            $roles = $this->userRepository->getUserAvailableRoles();
            return $this->render('salesman-add', ['messages' => $messages, 'user' => $user, 'roles' => $roles]);
        }
    }

    public function logout()
    {
        $this->userRepository->deleteUserSession(session_id());
        $_SESSION = [];
        session_regenerate_id(true);
        $this->redirect('login');
    }
}