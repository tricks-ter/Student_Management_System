<?php

class ReportController extends Controller {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $userModel = $this->model('User');
        $students = $userModel->getByRole('User');
        $this->view('report/index', ['students' => $students]);
    }

    public function generate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->model('User');
            $student = $userModel->getById($_POST['student_id']);

            $grades = [
                'Assignment 1' => 82,
                'Midterm' => 75,
                'Assignment 2' => 88,
                'Final Exam' => 91
            ];

            $average = array_sum($grades) / count($grades);
            $comment = trim($_POST['comment']);

            $this->view('report/result', [
                'student' => $student,
                'grades' => $grades,
                'average' => $average,
                'comment' => $comment
            ]);
        }
    }
}
