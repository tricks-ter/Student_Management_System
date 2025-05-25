<?php
require_once __DIR__ ."/../config/db.php"; 
require_once __DIR__ ."/../config/bootstrap.php"; 
require_once __DIR__ ."/../models/User.php";

function handle_forgot_password($conn ) {

    if($_SERVER['REQUEST_METHOD'] === "POST") {

        $email = $_POST["email"];
        
        $_SESSION["email"] = $email;

        $result = email_check($conn,$email);
        if($result){
            set_flash("Email found for Reset. A code has been sent to your email");
            header("Location: /webproject/reset");
            exit();
        }else{
            set_flash("Email not found");
        }

    }else{
        
        require_once __DIR__ ."/../views/forgot.php";
    }



}
function handle_reset( $conn ) {

    if($_SERVER['REQUEST_METHOD'] === "POST") {

        $email = $_SESSION["email"];
        $code = $_POST["code"];

        $result = reset_verify($conn,$email,$code);

        if($result){  

            set_flash("Code Verified");
            header("Location: /webproject/set_password");
            exit();


         }
         else{
            set_flash("Invalid Code");
            header("Location: /webproject/reset");
            exit();
         }



    }else{
        require __DIR__."/../views/reset.php";
    }
}
function handle_setPassword( $conn ) {
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        //validation needed
        $password = $_POST["password"];
        $email = $_SESSION["email"] ;
        $result = setPassword( $conn,$email, $password);
        if($result){
            set_flash("Password Changed successfully");
            setSession($conn,$email);
            header("Location: /webproject/dashboard");
            
        }
        else{
            set_flash("ERROR");
        }


    }else{
        require __DIR__."/../views/setpass.php";
    }

}






?>