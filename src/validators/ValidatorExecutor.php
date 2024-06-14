<?php

require_once 'Validator.php';

class ValidatorExecutor {
    private $validators;

    /**
     * ValidatorExecutor constructor.
     * @param Validator[] $validators An array of Validator objects.
     */

    public function __construct(array $validators) {
        $this->validators = $validators;
    }

    public function run($input, $fieldName) {
        $errors = [];

        foreach ($this->validators as $validator) {
            $result = $validator->validate($input, $fieldName);
            if ($result !== null) {
                $errors[] = $result;
            }
        }

        return $errors;
    }
}