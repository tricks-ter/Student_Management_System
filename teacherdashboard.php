<?php
session_start();
if ($_SESSION["user"] != "teacher") {
  header("Location: teacherlogin.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Teacher Dashboard</title>
</head>
<body>
  <h2>Welcome Teacher</h2>
  <ul>
    <li><a href="attendance.html">Track Attendance</a></li>
    <li><a href="teacherassignment.html">Teacher Assignments</a></li>
  </ul>
</body>
</html>