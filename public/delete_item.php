<?php
include "db_config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM test WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
        exit();
    } else {
        echo "Error deleting item: " . mysqli_error($conn);
    }
} else {
    header("Location: home.php");
    exit();
}
