<?php
require_once __DIR__ . '/../config/bootstrap.php';

if (isset($_SESSION['flash_success'])) {
    echo "<p style='color: green; font-weight: bold;'>" . $_SESSION['flash_success'] . "</p>";
    unset($_SESSION['flash_success']);
}

if (isset($_SESSION['flash_error'])) {
    echo "<p style='color: red; font-weight: bold;'>" . $_SESSION['flash_error'] . "</p>";
    unset($_SESSION['flash_error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="/webproject/register" method="post">
        <label>Full Name:</label><br>
        <input type="text" name="username"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" ><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" ><br><br>

        <label>Date of Birth:</label><br>
        <input type="date" name="dob" ><br><br>

        <label>Role:</label><br>
        <select name="role" >
            <option value="">Select Role</option>
            <option value="Student">Student</option>
            <option value="Teacher">Teacher</option>
            <option value="Admin">Admin</option>
        </select><br><br>

        <label>Phone Number:</label><br>
        <input type="text" name="phone" ><br><br>

        <label>Address:</label><br>
        <textarea name="address" rows="3" ></textarea><br><br>

        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="/webproject/login">Login here</a>.</p>
    <?php
        if (isset($_SESSION['flash'])) {
            echo "<p style='color: green'>" . $_SESSION['flash'] . "</p>";
            unset($_SESSION['flash']); 
        }
        ?>

</body>
</html>
