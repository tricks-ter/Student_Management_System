<?php
require_once __DIR__ . '/config/bootstrap.php';
require_once __DIR__."/controllers/AuthController.php";
require_once __DIR__."/controllers/verificationcontroller.php";
require_once __DIR__."/controllers/forgotcontroller.php";


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/webproject', '', $uri);
$uri = trim($uri, '/');
print_r($_SESSION);

switch ($uri) {
    case '':
        require __DIR__."/views/home.php";
        break;
    case "makedbtable":
        require __DIR__."/config/dbtable.php";
        break;
    case "login":
        handel_login($conn);
        break;
    case "register":
        handel_register($conn);
        break;
    case "forgot":
        handle_forgot_password($conn);
        break;
    case "reset":
        handle_reset($conn);
        break;
    case "set_password":
        handle_setPassword($conn);
        break;
    case "dashboard":
        if (isset($_SESSION["is_verified"])) {
            require __DIR__."/views/dashboard.php";
        }
        else{
            header("Location: /webproject/");
        }
        break;
    case "verification":
        handel_verification($conn);
        break;
    case "verify":
        require __DIR__."/views/verify.php";
    case "test":
        require __DIR__."/views/test.php";
        break;
    case "logout":
        handle_logout();
        break;
    default:
        require __DIR__."/views/404.php";
        break;



}



?>