<?php
require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/partials/navbar.php';

?>
<h1>HI,<?php echo $_SESSION['username']."(".$_SESSION['role'].")" ?></h1>
<form action="/webproject/logout" method="post" style="display:inline;">
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
