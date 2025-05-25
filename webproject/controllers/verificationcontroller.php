<?php
require_once __DIR__ ."/../config/db.php"; 
require_once __DIR__ ."/../config/bootstrap.php"; 



function handel_verification($conn) {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $code = trim($_POST["code"] ?? '');
        $email = $_SESSION["email"] ?? '';

        if (isset($_SESSION["is_verified"]) && $_SESSION["is_verified"] === true) {
            header("Location: /webproject/dashboard");
            exit();
        }
       

        if (empty($code) || empty($email)) {
            set_flash("Email and code are required.", "error");
            require __DIR__ . "/../views/verify.php";
            exit;
        }

        $verification = verify($conn, $code);

        if ($verification === true) {
            $_SESSION["is_verified"] = true;
            set_flash("User Successfully Verified");
            header("Location: /webproject/dashboard");
            exit;
        } else {
            set_flash("Invalid Code!", "error");
            require __DIR__ . "/../views/verify.php";
            exit;
        }
    } else {
        require __DIR__ . "/../views/verify.php";
    }
}




?>

