<?php

class Client {
    private $first_name;
    private $last_name;
    private $city;
    private $street;
    private $house_number;
    private $postal_code;
    private $company_name;
    private $id;

    public function __construct(
        string $first_name,
        string $last_name,
        string $city,
        string $street,
        string $house_number,
        string $postal_code,
        string $company_name,
        int $id
    ) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->city = $city;
        $this->street = $street;
        $this->house_number = $house_number;
        $this->postal_code = $postal_code;
        $this->company_name = $company_name;
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $name): void
    {
        $this->last_name = $name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
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
        return $this->house_number;
    }

    public function getPostalCode(): string
    {
        return $this->postal_code;
    }

    public function getCompanyName(): string
    {
        return $this->company_name;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
