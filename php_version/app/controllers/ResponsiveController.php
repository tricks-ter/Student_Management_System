<?php

class ResponsiveController extends Controller {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }
        $this->view('responsive/index');
    }
}
