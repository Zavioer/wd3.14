<?php

require_once __DIR__.'../../repository/UserRepository.php';
require_once __DIR__.'../../controllers/AppController.php';

class AuthMiddleware
{
    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function __invoke($input, $next) {
        if (session_status() == PHP_SESSION_ACTIVE) {
            $user = $this->userRepository->getUserBySessionID(session_id());
            
            if (is_null($user)) {
                AppController::redirect('unauthorized', 401, TRUE);
            } 
            $input['user'] = $user;
            return $next($input);
        }

        header('HTTP/1.1 500 Server internal error');
        exit();
    }
}