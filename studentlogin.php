<!-- studentlogin.php -->
<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // For demonstration only. Use hashed passwords and DB in real projects.
  if ($username == "student1" && $password == "1234") {
    $_SESSION["user"] = "student";
    header("Location: studentdashboard.php");
    exit;
  } else {
    $error = "Invalid username or password.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Login</title>
</head>
<body>
  <h2>Student Login</h2>
  <form method="post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
  </form>
  <p style="color:red"><?php echo $error; ?></p>
</body>
</html>