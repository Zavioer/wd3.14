<?php

require_once 'Form.php';
require_once __DIR__.'/../models/User.php';


class UserForm extends BaseForm {
    protected function prepare() {
        $this->validators = [
            'first-name' => [new SpecialCharactersValidator(), new TextLengthValidator(3, 255)],
            'last-name' => [new SpecialCharactersValidator(), new TextLengthValidator(3, 255)],
            'email' => [new EmailValidator()],
            'licence-code' => [new SpecialCharactersValidator(), new TextLengthValidator(3, 255)],
            'city' => [new SpecialCharactersValidator(), new TextLengthValidator(3, 255)],
            'street' => [new SpecialCharactersValidator(), new TextLengthValidator(3, 255)],
            'house-number' => [new SpecialCharactersValidator(), new TextLengthValidator(0, 10)],
            'postal-code' => [new SpecialCharactersValidator(), new TextLengthValidator(0, 6)],
        ];
    }

    public function getValidatedModel() {
        return new User(
            $this->data['email'],
            $this->data['password'],
            $this->data['first-name'],
            $this->data['last-name'],
            $this->data['licence-code'],
            $this->data['city'],
            $this->data['street'],
            $this->data['house-number'],
            $this->data['postal-code'],
            $this->data['role'],
            $this->data['id'] ?? -1
        );
    }
}
