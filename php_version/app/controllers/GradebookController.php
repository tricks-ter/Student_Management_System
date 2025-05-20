<?php

class GradebookController extends Controller {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $userModel = $this->model('User');
        $students = $userModel->getByRole('User');

        $assignments = [
            ['name' => 'Assignment 1', 'weight' => 0.2],
            ['name' => 'Midterm', 'weight' => 0.3],
            ['name' => 'Assignment 2', 'weight' => 0.2],
            ['name' => 'Final Exam', 'weight' => 0.3]
        ];

        $this->view('gradebook/index', [
            'students' => $students,
            'assignments' => $assignments
        ]);
    }
}
