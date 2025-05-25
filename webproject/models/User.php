<?php
require_once __DIR__ . "/../config/bootstrap.php";
require_once __DIR__."/../config/db.php";

function user_reg($conn, $username, $email, $password, $dob, $role, $phone, $address){
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

    $sql = "INSERT INTO users (fullname, email, password, dob, role, phone, address, verification_code) 
        VALUES ('$username', '$email', '$hashed_password', '$dob', '$role', '$phone', '$address', '$code')";
    
    $result = mysqli_query($conn,$sql);
    if($result){
        
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["role"] = $role;
        $_SESSION["phone"] = $phone;
        $_SESSION["address"] = $address;
        $_SESSION["dateofbirth"] = $dob;
        $_SESSION["verification_code"] = $code;

        return true;
    }else{
        return false;
    }
}

function user_auth($conn, $email, $password) {

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            
            $_SESSION["username"] = $row["fullname"]; 
            $_SESSION["email"] = $row["email"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["phone"] = $row["phone"];
            $_SESSION["address"] = $row["address"];
            $_SESSION["dateofbirth"] = $row["dob"];
            $_SESSION["is_verified"] = (bool) $row["is_verified"];

            return true;
        } else {
            return false; 
        }
    } else {
        echo "user not found.";
        return false;
    }
}

function verify($conn , $code) {
    $email = $_SESSION['email'];
    $sql = "SELECT verification_code FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    if ($user && $user['verification_code'] === $code) {
        
        $update_sql = "UPDATE users SET is_verified = 1 WHERE email = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "s", $email);
        mysqli_stmt_execute($update_stmt);
        

        return true;
    } else {
        return false;
    }


}
function reset_verify($conn ,$email, $code) {
    
    $sql = "SELECT verification_code FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    if ($user && $user['verification_code'] === $code) {
        
        $update_sql = "UPDATE users SET is_reset = 1 WHERE email = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "s", $email);
        mysqli_stmt_execute($update_stmt);
        

        return true;
    } else {
        return false;
    }


}



function email_check( $conn , $email ) {
    echo $email;

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && $user["email"] === $email) {
        
        return true;

    }
    else{
        
        return false;
    }


}

function setPassword($conn, $email, $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $email); 
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        return true;
    } else {
        return false;
    }
}


function setSession($conn, $email) {


    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        
            
            $_SESSION["username"] = $row["fullname"]; 
            $_SESSION["email"] = $row["email"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["phone"] = $row["phone"];
            $_SESSION["address"] = $row["address"];
            $_SESSION["dateofbirth"] = $row["dob"];
            $_SESSION["is_verified"] = (bool) $row["is_verified"];

            return true;
        } else {
            echo "user not found";
            return false; 
        }
    } 










?>