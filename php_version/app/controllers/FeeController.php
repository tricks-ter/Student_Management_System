<?php

class FeeController extends Controller {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $data = [
            'name' => $_SESSION['username'],
            'studentId' => 'STD' . str_pad($_SESSION['user_id'], 5, '0', STR_PAD_LEFT),
            'semester' => 'Spring 2025',
            'totalFee' => 30000,
            'paidAmount' => $_SESSION['paid_fee'] ?? 10000,
            'dueDate' => '2025-06-15'
        ];

        $today = new DateTime();
        $due = new DateTime($data['dueDate']);
        $daysLate = max(0, $due->diff($today)->days);
        $lateFee = $daysLate > 0 ? $daysLate * 10 : 0;

        $data['dueAmount'] = $data['totalFee'] - $data['paidAmount'];
        $data['lateFee'] = $lateFee;
        $data['totalDue'] = $data['dueAmount'] + $lateFee;

        $this->view('fee/index', $data);
    }

    public function pay() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['paid_fee'] = 30000;
            header("Location: /fee/index");
            exit();
        }
    }
}
