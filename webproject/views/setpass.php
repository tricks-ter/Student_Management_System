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
    <form method="post" action="/webproject/set_password">
    <input type="password" name="password" placeholder="New password">
    <button type="submit">Verify</button>
</form>

</body>
</html>