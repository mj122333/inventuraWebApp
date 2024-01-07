<?php

if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
}


















// echo basename(__FILE__, '.php');


require_once "views/homeview.php";
