<?php
require_once __DIR__ . '/../config/bootstrap.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
<form action="/webproject/login" method="post">
    <label>Email:</label><br>
    <input type="email" name="email" ><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" ><br><br>

    <button type="submit">Login</button>
</form>
<p><a href="/webproject/forgot">Forgot Password?</a></p>
<p>Don't have an account? <a href="/webproject/register">Register here</a>.</p>

</body>
</html>