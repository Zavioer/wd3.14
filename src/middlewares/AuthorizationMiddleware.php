<?php

require_once __DIR__.'../../repository/UserRepository.php';

class AuthorizationMiddleware
{
    public function __construct($expectedPermission) {
        $this->userRepository = new UserRepository();
        $this->expectedPermission = $expectedPermission;

    }

    public function __invoke($input, $next) {
        $user = $input['user'];
        if ($user !== null) {
            if (!in_array($this->expectedPermission, $user->getPermissions())) {
                header('HTTP/1.1 403 Forbidden');
                echo "<h1>Forbidden</h1>";
                exit();
            } 
            return $next($input);
        }

        header('HTTP/1.1 500 Server internal error');
        exit();
    }
}