<?php

class User {
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $licenceCode;
    private $city;
    private $street;
    private $houseNumber;
    private $postalCode;
    private $role_id;
    private $id;
    private $role;
    private $permission = [];

    public function __construct(
        string $email,
        string $password,
        string $firstName,
        string $lastName,
        string $licenceCode,
        string $city,
        string $street,
        string $houseNumber,
        string $postalCode,
        int $role_id,
        int $id = -1
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->licenceCode = $licenceCode;
        $this->city = $city;
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->postalCode = $postalCode;
        $this->role_id = $role_id;
        $this->id = $id;
    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
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

    public function getLicenceCode(): string
    {
        return $this->licenceCode;
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
    public function getRoleId(): string
    {
        return $this->role_id;
    }
    public function getID(): int
    {
        return $this->id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    public function getPermissions()
    {
        return $this->permissions;
    }
}