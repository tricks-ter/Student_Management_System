<?php

class LoginController extends Controller {
    public function index() {
        $this->view('login/index');
    }

    public function authenticate() {
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];

        if (isset($_POST['remember'])) {
            setcookie('remember_email', $email, time() + (86400 * 30), "/");
        } else {
            setcookie('remember_email', '', time() - 3600, "/");
        }

        header("Location: /dashboard");
        exit();
    }

    }
}
