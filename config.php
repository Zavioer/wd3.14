<?php

class Config
{
    private static $instance = null;
    private $settings = [];

    private function __construct()
    {
        $this->settings = [
            'USERNAME' => getenv('USERNAME'),
            'PASSWORD' => getenv('PASSWORD'),
            'HOST' => getenv('HOST'),
            'DATABASE' => getenv('DATABASE')
        ];
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get($key)
    {
        return isset($this->settings[$key]) ? $this->settings[$key] : null;
    }
}