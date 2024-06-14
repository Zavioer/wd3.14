<?php

class User {
    private $email;
    private $password;
    private $first_name;
    private $last_name;
    private $licence_code;
    private $city;
    private $street;
    private $house_number;
    private $postal_code;
    private $role_id;
    private $id;
    private $role;
    private $isAuthorized = FALSE;
    private $permission = [];

    public function __construct(
        string $email,
        string $password,
        string $first_name,
        string $last_name,
        string $licence_code,
        string $city,
        string $street,
        string $house_number,
        string $postal_code,
        int $role_id,
        int $id = -1
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->licence_code = $licence_code;
        $this->city = $city;
        $this->street = $street;
        $this->house_number = $house_number;
        $this->postal_code = $postal_code;
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

    public function getLicenceCode(): string
    {
        return $this->licence_code;
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

    public function authorize()
    {
        $this->isAuthorized = True;
    }

    public function isAuthorized()
    {
        return $this->isAuthorized();
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