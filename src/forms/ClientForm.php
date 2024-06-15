<?php

require_once "Form.php";
require_once __DIR__.'/../models/Client.php';

class ClientForm extends BaseForm {
    protected function prepare() {
        $this->validators = [
            'first-name' => [new SpecialCharactersValidator(), new TextLengthValidator(3, 255)],
            'last-name' => [new SpecialCharactersValidator(), new TextLengthValidator(3, 255)],
            'city' => [new SpecialCharactersValidator(), new TextLengthValidator(3, 255)],
            'street' => [new SpecialCharactersValidator(), new TextLengthValidator(3, 255)],
            'house-number' => [new SpecialCharactersValidator(), new TextLengthValidator(0, 10)],
            'postal-code' => [new SpecialCharactersValidator(), new TextLengthValidator(0, 6)],
            'phone' => [new SpecialCharactersValidator(), new TextLengthValidator(9, 9)],
            'email' => [new EmailValidator()],
        ];
    }

    public function getValidatedModel() {
        return new Client(
            $this->data['first-name'],
            $this->data['last-name'],
            $this->data['city'],
            $this->data['street'],
            $this->data['house-number'],
            $this->data['postal-code'],
            $this->data['phone'],
            $this->data['email'],
            $this->data['id'] ?? -1
        );
    }
}
