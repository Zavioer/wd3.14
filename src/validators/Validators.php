<?php

require_once 'Validator.php';

class NumberValidator implements Validator {
    public function validate($input, $fieldName) {
        if (!is_numeric($input)) {
            return "$fieldName must be a number.";
        }
        return null; // Validation passed
    }
}

class AlphanumericValidator implements Validator {
    public function validate($input, $fieldName) {
        if (!ctype_alnum($input)) {
            return "$fieldName must be alphanumeric.";
        }
        return null; // Validation passed
    }
}

class NullValidator implements Validator {
    public function validate($input, $fieldName) {
        if (!is_null($input)) {
            return "$fieldName must be null.";
        }
        return null; // Validation passed
    }
}

class ChoiceValidator implements Validator {
    private array $choices;

    public function __construct(array $choices) {
        $this->choices = $choices;
    }

    public function validate($input, $fieldName) {
        if (!in_array($input, $this->choices)) {
            return "$fieldName must be one of: " . implode(", ", $this->choices);
        }
        return null; // Validation passed
    }
}

class TextLengthValidator implements Validator {
    private int $minLength;
    private int $maxLength;

    public function __construct(int $minLength, int $maxLength) {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    public function validate($input, $fieldName) {
        $length = strlen($input);
        if ($length < $this->minLength || $length > $this->maxLength) {
            return "$fieldName length must be between {$this->minLength} and {$this->maxLength} characters.";
        }
        return null; // Validation passed
    }
}

class RegexValidator implements Validator {
    private string $pattern;

    public function __construct(string $pattern) {
        $this->pattern = $pattern;
    }

    public function validate($input, $fieldName) {
        if (!preg_match($this->pattern, $input)) {
            return "$fieldName does not match the required pattern.";
        }
        return null; // Validation passed
    }
}

class NumberInRangeValidator implements Validator {
    private float $minValue;
    private float $maxValue;

    public function __construct(float $minValue, float $maxValue = PHP_FLOAT_MAX) {
        $this->minValue = $minValue;
        $this->maxValue = $maxValue;
    }

    public function validate($input, $fieldName) {
        if (!is_numeric($input)) {
            return "$fieldName must be a number.";
        }
        
        $number = (float)$input;
        if ($number < $this->minValue || $number > $this->maxValue) {
            return "$fieldName must be between {$this->minValue} and {$this->maxValue}.";
        }
        
        return null; // Validation passed
    }
}

class EmailValidator implements Validator {
    public function validate($input, $fieldName): ?string {
        if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return "The $fieldName field must contain a valid email address.";
        }
        return null;
    }
}