<?php

class Product {
    private $id;
    private $name;
    private $upc;
    private $description;
    private $price;
    private $uom;
    private $product_type_id;

    public function __construct(
        int $id,
        string $name,
        string $upc,
        string $description,
        float $price,
        string $uom,
        int $product_type_id
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->upc = $upc;
        $this->description = $description;
        $this->price = $price;
        $this->uom = $uom;
        $this->product_type_id = $product_type_id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    
    public function getUpc(): string
    {
        return $this->upc;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getUom(): string
    {
        return $this->uom;
    }

    public function getProductTypeId(): int
    {
        return $this->product_type_id;
    }
}