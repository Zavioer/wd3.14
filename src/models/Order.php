<?php

class Order {
    private $id;
    private $clientId;
    private $salesmanId;
    private $creationDate;
    private $finishDate;
    private $totalPrice;
    private $discount;
    private $state;

    public function __construct(
        int $id,
        int $clientId,
        int $salesmanId,
        $creationDate,
        $finishDate,
        $totalPrice,
        $discount,
        $state
    ) {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->salesmanId = $salesmanId;
        $this->creationDate = $creationDate;
        $this->finishDate = $finishDate;
        $this->totalPrice = $totalPrice;
        $this->discount = $discount;
        $this->state = $state;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }
    
    public function getSalesmanId(): int
    {
        return $this->salesmanId;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function getFinishDate()
    {
        return $this->finishDate;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function getDiscount()
    {
        return $this->discount;
    }
}