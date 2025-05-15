<?php
session_start();
if ($_SESSION["user"] != "parent") {
  header("Location: parent_login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Parent Dashboard</title>
</head>
<body>
  <h2>Welcome Parent</h2>
  <a href="parentportal.html">Go to Parent Portal</a>
</body>
</html>