<?php

function getUcionice()
{
    global $db;

    $result = $db->select("SELECT id, oznaka FROM ucionice");
    // $ucionice = array();
    // foreach ($result["result"] as $row) {
    //     $ucionice[] = $row;
    // }

    return $result;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scannedValue = trim($_POST['kod']);
    // $scannedValue = mysqli_real_escape_string($conn, $scannedValue);
    if (!empty($scannedValue)) {
        // echo "<p>$scannedValue</p>";
        $sql = "INSERT INTO test (id) VALUES (" . $scannedValue . ")";
        $db->insert($sql);
        // mysqli_query($conn, $sql);
        // $myfile = fopen("testfile.txt", "a");
        // fwrite($myfile, $scannedValue . " ");
    }

    unset($_POST);
    header("Location: profile");
    exit;
}


echo basename(__FILE__, '.php');


require_once "views/profileview.php";
