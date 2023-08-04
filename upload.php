<?php
include "config/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    http_response_code(200);
}
$sql = "SELECT * FROM test";
$result = mysqli_query($conn, $sql);
