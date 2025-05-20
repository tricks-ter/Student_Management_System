<!DOCTYPE html>
<html>
<head>
  <title>EduSystem</title>
  <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
  <nav class="navbar">
    <div class="logo">EduSystem</div>
    <ul class="nav-links">
      <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="/home/dashboard">Dashboard</a></li>
        <li><a href="/logout">Logout</a></li>
      <?php else: ?>
        <li><a href="/home/index">Home</a></li>
        <li><a href="/login">Login</a></li>
        <li><a href="/register">Register</a></li>
      <?php endif; ?>
    </ul>
  </nav>

  <div class="container">
    <?php require_once __DIR__ . '/../' . $view . '.php'; ?>
  </div>
</body>
</html>
