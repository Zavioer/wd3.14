<?php

class OrderDetailed {
    private $orderId;
    private $clientFirstName;
    private $clientLastName;
    private $salesmanFirstName;
    private $salesmanLastName;
    private $creationDate;
    private $finishDate;
    private $discount;
    private $totalPrice;
    private $state;
    private $productId;
    private $productName;
    private $amount;

    public function __construct(
        $orderId,
        $clientFirstName,
        $clientLastName,
        $salesmanFirstName,
        $salesmanLastName,
        $creationDate,
        $finishDate,
        $discount,
        $totalPrice,
        $state,
        $productId,
        $productName,
        $amount
    ) {
        $this->orderId = $orderId;
        $this->clientFirstName = $clientFirstName;
        $this->clientLastName = $clientLastName;
        $this->salesmanFirstName = $salesmanFirstName;
        $this->salesmanLastName = $salesmanLastName;
        $this->creationDate = $creationDate;
        $this->finishDate = $finishDate;
        $this->discount = $discount;
        $this->totalPrice = $totalPrice;
        $this->state = $state;
        $this->productId = $productId;
        $this->productName = $productName;
        $this->amount = $amount;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }
    
    public function getClientFirstName()
    {
        return $this->clientFirstName;
    }

    public function getClientLastName()
    {
        return $this->clientLastName;
    }

    public function getSalesmanFirstName()
    {
        return $this->salesmanFirstName;
    }

    public function getSalesmanLastName()
    {
        return $this->salesmanLastName;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function getFinishDate()
    {
        return $this->finishDate;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getAmount()
    {
        return $this->amount;
    }
}