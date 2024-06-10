<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/OrdersCountByProductType.php';
require_once __DIR__.'/../models/OrdersCountByProductTypeEntry.php';
require_once __DIR__.'/../models/MonthlyIncome.php';
require_once __DIR__.'/../models/MonthlyIncomeEntry.php';

class ReportRepository extends Repository
{
    public function getOrdersCountByProductType($year, $month)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * 
            FROM vw_orders_count_by_product_type 
            WHERE year = :year AND month = :month
        ');
        $stmt->bindParam(':year', $year, PDO::PARAM_INT); 
        $stmt->bindParam(':month', $month, PDO::PARAM_INT); 
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $entries = [];

        foreach ($result as $entry) {
            $newEntry = new OrdersCountByProductTypeEntry(
                $entry['year'],
                $entry['month'],
                $entry['product_type_name'],
                $entry['orders_count'],
            );
            array_push($entries, $newEntry);
        }

        return new OrdersCountByProductType($entries);
    }

    public function getMonthlyIncome($year)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * 
            FROM vw_monthly_income 
            WHERE year = :year
        ');
        $stmt->bindParam(':year', $year, PDO::PARAM_INT); 
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $entries = [];

        foreach ($result as $entry) {
            $newEntry = new MonthlyIncomeEntry(
                $entry['year'],
                $entry['month'],
                $entry['total_price'],
            );
            array_push($entries, $newEntry);
        }

        return new MonthlyIncome($entries);
    }
}
