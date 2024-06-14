<?php

class Client {
    private $firstName;
    private $lastName;
    private $city;
    private $street;
    private $houseNumber;
    private $postalCode;
    private $phone;
    private $email;
    private $id;

    public function __construct(
        string $firstName,
        string $lastName,
        string $city,
        string $street,
        string $houseNumber,
        string $postalCode,
        ?string $phone = '',
        ?string $email = '',
        int $id = -1
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->city = $city;
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->postalCode = $postalCode;
        $this->phone = $phone;
        $this->email = $email;
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $name): void
    {
        $this->lastName = $name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
