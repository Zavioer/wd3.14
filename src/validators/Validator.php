<?php

interface Validator {
    public function validate($input, $fieldName);
}