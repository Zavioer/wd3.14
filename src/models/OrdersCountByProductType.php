<?php

class OrdersCountByProductType implements JsonSerializable {
    private $entries;

    public function __construct(
        $entries
    ) {
        $this->entries = $entries;
    }

    public function jsonSerialize()
    {
        return [
            'year' => $this->getYear(),
            'month' => $this->getMonth(),
            'productTypeName' => $this->getProductTypeName(),
            'ordersCount' => $this->getOrdersCount(),
        ];
    }

    public function getYear()
    {
        $result = [];
        foreach ($this->entries as $entry) {
            array_push($result, $entry->getYear());
        }
        return $result;
    }

    public function getMonth()
    {
        $result = [];
        foreach ($this->entries as $entry) {
            array_push($result, $entry->getMonth());
        }
        return $result;
    }

    public function getProductTypeName()
    {
        $result = [];
        foreach ($this->entries as $entry) {
            array_push($result, $entry->getProductTypeName());
        }
        return $result;
    }

    public function getOrdersCount()
    {
        $result = [];
        foreach ($this->entries as $entry) {
            array_push($result, $entry->getOrdersCount());
        }
        return $result;
    }
}