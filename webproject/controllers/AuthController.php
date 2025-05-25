<?php
require_once __DIR__ . "/../config/bootstrap.php";
require_once __DIR__ . "/../models/User.php";




function handel_register($conn) {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $username = trim($_POST["username"] ?? '');
        $email = trim($_POST["email"] ?? '');
        $password = trim($_POST["password"] ?? '');
        $dob = $_POST["dob"] ?? '';
        $role = $_POST["role"] ?? '';
        $phone = trim($_POST["phone"] ?? '');
        $address = trim($_POST["address"] ?? '');

        
        $errors = [];

        if (empty($username)) $errors[] = "Username is required.";
        if (empty($email)) $errors[] = "Email is required.";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
        if (empty($password) || strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
        if (empty($dob)) $errors[] = "Date of birth is required.";
        if (empty($role)) $errors[] = "Role is required.";
        if (empty($phone)) $errors[] = "Phone number is required.";
        if (!preg_match("/^\d{10,15}$/", $phone)) $errors[] = "Phone number must be 10–15 digits.";
        if (empty($address)) $errors[] = "Address is required.";

        if (!empty($errors)) {
            set_flash(implode(" ", $errors), "error");
            require __DIR__ . "/../views/register.php";
            return;
        }

        
        $result = user_reg($conn, $username, $email, $password, $dob, $role, $phone, $address);
        if ($result) {
            set_flash("Waiting for Verification");
            header("Location: /webproject/verify");
            exit;
        } else {
            set_flash("Registration failed. Please try again.", "error");
            require __DIR__ . "/../views/register.php";
        }
    } else {
        require __DIR__ . "/../views/register.php";
    }
}

function handel_login($conn) {
   

    if(isset($_SESSION["username"])){
        set_flash("Login successful.");
        require __DIR__ . "/../views/dashboard.php";

    }else{
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $email = trim($_POST["email"] ?? '');
        $password = trim($_POST["password"] ?? '');

        if (empty($email) || empty($password)) {
            set_flash("Email and password are required.", "error");
            require __DIR__ . "/../views/login.php";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            set_flash("Invalid email format.", "error");
            require __DIR__ . "/../views/login.php";
            return;
        }

        $result = user_auth($conn, $email, $password);

        if ($result) {
            set_flash("Login successful.");
            header("Location: /webproject/dashboard");
        } else {
            set_flash("Login failed. Incorrect email or password.", "error");
            require __DIR__ . "/../views/login.php";
        }
    } else {
        require __DIR__ . "/../views/login.php";
    }

    }

    
}


function handle_logout() {
    
        $_SESSION = [];
        $_COOKIE =[];


        session_destroy();
        set_flash("Logout successful.");
        header("Location: /webproject/");
        exit;
    
}




?>
