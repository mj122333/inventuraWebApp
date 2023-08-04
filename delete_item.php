<?php
include "db_config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM test WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting item: " . mysqli_error($conn);
    }
}
