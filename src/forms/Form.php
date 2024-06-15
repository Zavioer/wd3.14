<?php

require_once __DIR__.'/../validators/ValidatorExecutor.php';
require_once __DIR__.'/../validators/Validators.php';

interface Form {
    public function __construct($formData);
    public function getData();
    public function validate();
    public function getValidatedModel();
}

class BaseForm implements Form {
    protected $data;
    protected $errors = [];
    protected $validators = [];

    public function __construct($formData) {
        $this->data = $formData;
        $this->prepare();
    }

    protected function prepare() {
        // This method should be overridden in derived classes
    }

    public function getData() {
        return $this->data;
    }

    public function validate() {
        foreach ($this->validators as $fieldName => $fieldValidators) {
            $input = isset($this->data[$fieldName]) ? $this->data[$fieldName] : null;
            $executor = new ValidatorExecutor($fieldValidators);
            $fieldErrors = $executor->run($input, $fieldName);
            if (!empty($fieldErrors)) {
                $this->errors = array_merge($this->errors, $fieldErrors);
            }
        }
        return empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getValidatedModel() {
        // This method should return model object related with form
    }
}