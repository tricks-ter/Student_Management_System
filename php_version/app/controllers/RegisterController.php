<?php

class RegisterController extends Controller {
    public function index() {
        $this->view('register/index');
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $userModel = $this->model('User');

            if ($userModel->emailExists($email)) {
                $this->view('register/index', ['error' => 'Email already exists']);
            } else {
                $userModel->create($username, $email, $password);
                header("Location: /login");
                exit();
            }
        }
    }
}
