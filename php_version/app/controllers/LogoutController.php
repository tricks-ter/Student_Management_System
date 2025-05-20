<?php

class LogoutController extends Controller {
    public function index() {
        if (isset($_POST['forget'])) {
            setcookie('remember_email', '', time() - 3600, "/");
        }

        session_unset();
        session_destroy();

        header("Location: /login");
        exit();
    }
}
