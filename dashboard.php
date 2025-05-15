<?php
session_start(); // Start the session

// Check if the user is logged in by verifying the session
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    // Redirect to login if not logged in
    header("Location: login.html");
    exit();
}

// If "Remember Me" cookie is set, auto login the user by setting the session
if (isset($_COOKIE['username']) && !isset($_SESSION['username'])) {
    $_SESSION['username'] = $_COOKIE['username']; // Set session from cookie
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>School Management Dashboard</title>

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f9;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #2c3e50;
      color: white;
      padding: 20px;
      text-align: center;
    }

    h1 {
      margin: 0;
    }

    .dashboard-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 30px;
    }

    .card {
      background-color: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      transition: transform 0.2s, box-shadow 0.2s;
      text-align: center;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .card h2 {
      color: #2980b9;
      margin-bottom: 10px;
    }

    .card p {
      font-size: 14px;
      color: #555;
    }

    .card a {
      display: inline-block;
      margin-top: 15px;
      padding: 8px 16px;
      background-color: #2980b9;
      color: white;
      border-radius: 5px;
      text-decoration: none;
    }

    .card a:hover {
      background-color: #1f6391;
    }
    
  </style>
</head>
<body>

  <header>
    <h1>School Management System</h1>
  </header>

  <div class="dashboard-container">

    <div class="card">
        <h2>Student Profile</h2>
        <p>View and edit student personal information.</p>
        <a href="studentprofile.html">Go to Profile</a>
      </div>

    <div class="card">
      <h2>Attendance Tracking</h2>
      <p>Log student attendance and generate reports.</p>
      <a href="attendance.html">Go to Attendance</a>
    </div>

    <div class="card">
      <h2>Parent Portal</h2>
      <p>View children’s progress and communicate with teachers.</p>
      <a href="parentportal.html">Go to Parent Portal</a>
    </div>

    <div class="card">
      <h2>Teacher Assignments</h2>
      <p>Assign workloads and manage substitutions.</p>
      <a href="teacherassignment.html">Go to Assignments</a>
    </div>

    <div class="card">
      <h2>Document Upload</h2>
      <p>Submit assignments and check for plagiarism.</p>
      <a href="docup.html">Go to Upload</a>
    </div>

  </div>

</body>
</html>