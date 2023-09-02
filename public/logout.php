<?php
// 
setcookie('sessionid', '', time() - 3600, '/');
session_destroy();
header("Location: login.php");
exit;
