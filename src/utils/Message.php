<?php

class Message {
    const INFO = 'informational';
    const SUCCESS = 'success';
    const ERROR = 'error';

    private $text;
    private $severity;

    public function __construct($text, $severity = self::INFO) {
        $this->text = $text;
        $this->severity = $severity;
    }

    public function getText() {
        return $this->text;
    }

    public function getSeverity() {
        return $this->severity;
    }
}