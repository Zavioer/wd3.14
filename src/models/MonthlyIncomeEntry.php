<?php

class MonthlyIncomeEntry {
    private $year;
    private $month;
    private $totalPrice;

    public function __construct(
        $year,
        $month,
        $totalPrice
    ) {
        $this->year = $year;
        $this->month = $month;
        $this->totalPrice = $totalPrice;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getTotalPrice()
    {
        return (float)$this->totalPrice;
    }
}