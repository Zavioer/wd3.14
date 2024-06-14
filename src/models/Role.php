<?php

class Role {
    const ADMIN = 'admin';
    const SALESMAN = 'salesman';
    const ANALYST = 'analyst';

    private $id;
    private $name;

    public function __construct(
        int $id,
        string $name
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}