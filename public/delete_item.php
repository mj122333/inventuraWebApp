<?php
require_once "config/config.php";
require_once "config/db_config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM test WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        $referer = explode(".", $_SERVER['HTTP_REFERER'])[0];
        header("Location: $referer");
        exit();
    } else {
        echo "Error deleting item: " . mysqli_error($conn);
    }
} else {
    header("Location: home");
    exit();
}
