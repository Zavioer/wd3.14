<?php

require_once __DIR__.'../../repository/UserRepository.php';

class AuthMiddleware
{
    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function __invoke($input, $next) {
        if (session_status() == PHP_SESSION_ACTIVE) {
            $user = $this->userRepository->getUserBySessionID(session_id());
            
            if (is_null($user)) {
                header('HTTP/1.1 401 Unauthorized');
                echo "<h1>Unauthorized</h1>";
                exit();
            } 
            return $next($input);
        }

        header('HTTP/1.1 500 Server internal error');
        exit();
    }
}