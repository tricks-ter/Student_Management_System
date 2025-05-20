<?php

class ExportController extends Controller {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $userModel = $this->model('User');
        $users = $userModel->getAllUsers();
        $this->view('export/index', ['users' => $users]);
    }

    public function csv() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $userModel = $this->model('User');
        $users = $userModel->getAllUsers();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="users.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Username', 'Email', 'Role']);

        foreach ($users as $user) {
            fputcsv($output, [$user['id'], $user['username'], $user['email'], $user['role']]);
        }

        fclose($output);
        exit();
    }
}
