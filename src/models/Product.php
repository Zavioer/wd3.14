<?php

class Product {
    private $id;
    private $name;
    private $upc;
    private $description;
    private $price;
    private $uom;
    private $productTypeId;
    private $imgPath;
    private $warehouseQuantity = 0;
    private $type;

    public function __construct(
        int $id,
        string $name,
        string $upc,
        string $description,
        float $price,
        string $uom,
        int $productTypeId,
        string $imgPath
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->upc = $upc;
        $this->description = $description;
        $this->price = $price;
        $this->uom = $uom;
        $this->productTypeId = $productTypeId;
        $this->imgPath = $imgPath;
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
        return $this->productTypeId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getImgPath(): string
    {
        return $this->imgPath;
    }

    public function setWarehouseQuantity($quantity)
    {
        $this->warehouseQuantity = $quantity;
    }

    public function getWarehouseQuantity()
    {
        return $this->warehouseQuantity;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }
}