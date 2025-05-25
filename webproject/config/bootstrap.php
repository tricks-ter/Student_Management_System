<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function set_flash($message, $type = 'success') {
    $_SESSION['toast'] = [
        'message' => $message,
        'type' => $type 
    ];
}
if (isset($_SESSION['flash_success'])) {
    echo "<p style='color: green; font-weight: bold;'>" . $_SESSION['flash_success'] . "</p>";
    unset($_SESSION['flash_success']);
}

if (isset($_SESSION['flash_error'])) {
    echo "<p style='color: red; font-weight: bold;'>" . $_SESSION['flash_error'] . "</p>";
    unset($_SESSION['flash_error']);
}
?>