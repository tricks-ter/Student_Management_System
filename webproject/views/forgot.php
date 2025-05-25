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
    <form method="post" action="/webproject/forgot">
    <input type="text" name="email" placeholder="Enter email">
    <button type="submit">submit</button>
</form>

</body>
</html>