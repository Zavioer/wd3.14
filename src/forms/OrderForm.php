<?php

require_once "Form.php";

class OrderForm extends BaseForm {
    protected function prepare() {
        $this->validators = [
            'amount' => [new NumberInRangeValidator(0)],
            'discount' => [new NumberInRangeValidator(0, 1)],
        ];
    }

    public function getValidatedModel() {
        // TODO: add new constructor with min number of params to `Order` class
        return null;
    }
}
