<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        $this->render('login');
    }

    public function dashboard($req) {
        $user = $req['user'];
        $this->render('dashboard', ['user' => $user]);
    }

    public function home() {
        $this->render('home');
    }
}