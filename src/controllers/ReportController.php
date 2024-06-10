<?php

require_once 'AppController.php';
require_once __DIR__.'../../repository/ReportRepository.php';

class ReportController extends AppController {
    private $productRepository;

    public function __construct()
    {
        parent::__construct();
        $this->reportRepository = new ReportRepository();
    }
        
    public function ordersCountByProductType($req) {
        $year = $_GET['year'] ?? date('Y');
        $month = $_GET['month'] ?? date('n');
        $report = $this->reportRepository->getOrdersCountByProductType($year, $month);
        $this->jsonify($report);
    }

    public function monthlyIncome($req) {
        $year = $_GET['year'] ?? date('Y');
        $report = $this->reportRepository->getMonthlyIncome($year);
        $this->jsonify($report);
    }
}