<?php

class Request {
    private $user;
    private $urlParam;

    private function __construct($urlParam) {
        $this->urlParam = $urlParam;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getUser() {
        return $this->$user;
    }

    public function getUrlParam() {
        return $this->urlParam;
    }
}