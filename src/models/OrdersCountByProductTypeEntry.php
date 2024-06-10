<?php

class OrdersCountByProductTypeEntry {
    private $year;
    private $month;
    private $productTypeName;
    private $ordersCount;

    public function __construct(
        $year,
        $month,
        $productTypeName,
        $ordersCount
    ) {
        $this->year = $year;
        $this->month = $month;
        $this->productTypeName = $productTypeName;
        $this->ordersCount = $ordersCount;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getProductTypeName()
    {
        return $this->productTypeName;
    }

    public function getOrdersCount()
    {
        return $this->ordersCount;
    }
}