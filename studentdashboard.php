<?php
session_start();
if ($_SESSION["user"] != "student") {
  header("Location: student_login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Dashboard</title>
</head>
<body>
  <h2>Welcome Student</h2>
  <ul>
    <li><a href="studentprofile.html">View Profile</a></li>
    <li><a href="docup.html">Upload Documents</a></li>
  </ul>
</body>
</html>