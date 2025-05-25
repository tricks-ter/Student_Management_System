<?php
require_once __DIR__ . '/bootstrap.php';
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'student_management';

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die(''. mysqli_connect_error());
}

?>