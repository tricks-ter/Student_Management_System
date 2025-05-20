<?php

class RoleController extends Controller {
    public function index() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
            header("Location: /login");
            exit();
        }

        $userModel = $this->model('User');
        $users = $userModel->getAllUsers();

        $this->view('role/index', ['users' => $users]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $newRole = $_POST['new_role'];
            $userModel = $this->model('User');
            $userModel->updateRole($userId, $newRole);
        }
        header("Location: /role/index");
        exit();
    }
}
