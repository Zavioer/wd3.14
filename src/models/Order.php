<?php

class Order {
    private $id;
    private $client_id;
    private $salesman_id;
    private $creation_date;
    private $finish_date;
    private $total_price;
    private $discount;
    private $state;

    public function __construct(
        int $id,
        int $client_id,
        int $salesman_id,
        $creation_date,
        $finish_date,
        $total_price,
        $discount,
        $state
    ) {
        $this->id = $id;
        $this->client_id = $client_id;
        $this->salesman_id = $salesman_id;
        $this->creation_date = $creation_date;
        $this->finish_date = $finish_date;
        $this->total_price = $total_price;
        $this->discount = $discount;
        $this->state = $state;
    }

    public function getClientId(): int
    {
        return $this->client_id;
    }
    
    public function getSalesmanId(): int
    {
        return $this->salesman_id;
    }

    public function getCreationDate()
    {
        return $this->creation_date;
    }

    public function getFinishDate()
    {
        return $this->finish_date;
    }

    public function getTotalPrice()
    {
        return $this->total_price;
    }

    public function getDiscount()
    {
        return $this->discount;
    }
}