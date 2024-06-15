<?php

require_once "Form.php";
require_once __DIR__.'/../models/Product.php';

class ProductForm extends BaseForm {
    protected function prepare() {
        $this->validators = [
            'name' => [new SpecialCharactersValidator(), new TextLengthValidator(3, 255)],
            'upc' => [new SpecialCharactersValidator(), new TextLengthValidator(3, 255)],
            'price' => [new NumberInRangeValidator(0)],
            'uom' => [new SpecialCharactersValidator(), new TextLengthValidator(1, 10)],
            'quantity' => [new SpecialCharactersValidator(), new NumberInRangeValidator(0)],
            'type' => [new SpecialCharactersValidator()],
        ];
    }

    public function getValidatedModel() {
        return new Product(
            $this->data['name'],
            $this->data['upc'],
            $this->data['description'] ?? '',
            $this->data['price'],
            $this->data['uom'],
            $this->data['type'],
            $this->data['img-path'],
            $this->data['id'] ?? -1
        );
    }
}
