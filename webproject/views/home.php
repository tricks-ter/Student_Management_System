<?php
require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/partials/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome to the Student Management System</h1>

<?php
    $dir = __DIR__.'/views';
     if (isset($_SESSION['user_id'])): ?>
    <p>Hello, <?= htmlspecialchars($_SESSION['user_name']) ?>!</p>
    <a href="/logout">Logout</a>
<?php else: ?>
    <div style="margin-top: 20px;">
        <a href="/webproject/login" style="
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        ">Login</a>

        <a href="/webproject/register" style="
            display: inline-block;
            padding: 10px 20px;
            background-color: #28A745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        ">Register</a>
    </div>
<?php endif;?>

</body>
</html>
