<?php

class ContactController extends Controller {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }
        $this->view('contact/index');
    }

    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $subject = trim($_POST['subject']);
            $message = trim($_POST['message']);

            $model = $this->model('ContactMessage');
            $model->save($name, $email, $subject, $message);

            $this->view('contact/index', ['success' => 'Message sent successfully.']);
        }
    }
}
