<?php
require_once __DIR__ ."/../../config/bootstrap.php";
$loggedIn = isset($_SESSION['email']);
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo __DIR__."/../../public/style.css"; ?>">
</head>
<body>
    <nav class="navbar">
    <div class="navbar-brand">
        <a href="/webproject/">Home Page</a>
    </div>
    <ul class="navbar-links">
        <?php if ($loggedIn): ?>
            <li><a href="/webproject/dashboard">Dashboard</a></li>
            <li><a href="/webproject/profile">Profile</a></li>
            <?php if ($isAdmin): ?>
                <li><a href="/webproject/admin">Admin Panel</a></li>
            <?php endif; ?>
            <li><a href="/webproject/logout">Logout</a></li>
        <?php else: ?>
            <li><a href="/webproject/login">Login</a></li>
            <li><a href="/webproject/register">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>
</body>
</html>
