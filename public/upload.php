<?php
include "db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["value"])) {
        $sql = "INSERT INTO test (id) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_GET["value"]);
        $stmt->execute();
        $myfile = fopen("testfile.txt", "a");
        fwrite($myfile, $_GET["value"] . " ");
    }
    http_response_code(200);
    header("Location: home.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["value"])) {
        $sql = "INSERT INTO test (id) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_POST["value"]);
        $stmt->execute();
        $myfile = fopen("testfile.txt", "a");
        fwrite($myfile, $_POST["value"] . " ");

        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');

        $sql = "INSERT INTO evidencija (proizvod_id, ucionica_id, datum, vrijeme, user_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($_POST["value"], 35, $currentDate, $currentTime, 6));
    }
    http_response_code(200);
}
// $sql = "SELECT * FROM test";
// $result = mysqli_query($conn, $sql);
