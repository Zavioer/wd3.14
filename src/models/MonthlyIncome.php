<?php

class MonthlyIncome implements JsonSerializable {
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
            'totalPrice' => $this->getTotalPrice(),
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

    public function getTotalPrice()
    {
        $result = [];
        foreach ($this->entries as $entry) {
            array_push($result, $entry->getTotalPrice());
        }
        return $result;
    }
}