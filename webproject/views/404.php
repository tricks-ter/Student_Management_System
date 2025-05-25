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
  <h1>404</h1>
<p>You've reached the end of Internet.</p>
<?php
echo $_SERVER['REQUEST_URI'];
?>
</body>
</html>