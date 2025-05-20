<?php

class FormController extends Controller {
    public function index() {
        $this->view('form/index');
    }

    public function submit() {
        $errors = [];
        $data = [
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password'])
        ];

        if (empty($data['username'])) {
            $errors['username'] = "Username is required";
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Valid email is required";
        }

        if (strlen($data['password']) < 6) {
            $errors['password'] = "Password must be at least 6 characters";
        }

        if (!empty($errors)) {
            $this->view('form/index', ['errors' => $errors, 'data' => $data]);
        } else {
            $this->view('form/index', ['success' => 'Form submitted successfully']);
        }
    }
}
