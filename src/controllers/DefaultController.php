<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        $this->render('login-desktop');
    }

    public function dashboard() {
        $this->render('home-desktop');
    }
}