<?php

class CourseController extends Controller {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $courses = [
            ['code' => 'CS101', 'name' => 'Intro to CS', 'credits' => 3],
            ['code' => 'MATH201', 'name' => 'Calculus I', 'credits' => 4],
            ['code' => 'ENG301', 'name' => 'English Comp', 'credits' => 2],
            ['code' => 'PHY110', 'name' => 'Physics', 'credits' => 3],
            ['code' => 'HIST101', 'name' => 'World History', 'credits' => 2]
        ];

        $this->view('course/index', ['courses' => $courses]);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selected = $_POST['course'] ?? [];
            $_SESSION['registered_courses'] = $selected;
            $this->view('course/index', ['courses' => [], 'success' => 'Courses registered successfully.']);
        }
    }
}
