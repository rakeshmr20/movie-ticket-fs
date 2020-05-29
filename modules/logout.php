<?php
// Developed by Rakesh M R
unset($_SESSION['userId']);
unset($_SESSION['userName']);
session_destroy();
// header('Location: ?page=home');
echo "<script>window.location.href='?page=home';</script>";
exit;
?>