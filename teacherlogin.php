<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Simple validation (replace with DB validation in real-world apps)
  if ($username == "teacher1" && $password == "1234") {
    $_SESSION["user"] = "teacher";
    header("Location: teacherdashboard.php");
    exit;
  } else {
    $error = "Invalid username or password.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Teacher Login</title>
</head>
<body>
  <h2>Teacher Login</h2>
  <form method="post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
  </form>
  <p style="color:red"><?php echo $error; ?></p>
</body>
</html>