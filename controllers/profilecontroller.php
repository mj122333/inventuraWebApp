<?php


// funkcija koja azurira podatke usera ovisno o post zahtjevu
function updateUser() // TODO provjeriti ako ne postoji user s tim usernameom
{
    global $db;

    $ime = $_POST["ime"];
    $prezime = $_POST["prezime"];
    $username = $_POST["username"];
    $id = $_SESSION["id"];

    $db->update("UPDATE vl_users SET ime=?, prezime=?, username=? WHERE id=?", array($ime, $prezime, $username, $id));

    login_with_id($_SESSION["id"]);
}

if (isset($_POST["update_user"])) {
    updateUser();
}



// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $scannedValue = trim($_POST['kod']);
//     // $scannedValue = mysqli_real_escape_string($conn, $scannedValue);
//     if (!empty($scannedValue)) {
//         // echo "<p>$scannedValue</p>";
//         $sql = "INSERT INTO test (id) VALUES (" . $scannedValue . ")";
//         $db->insert($sql);
//         // mysqli_query($conn, $sql);
//         // $myfile = fopen("testfile.txt", "a");
//         // fwrite($myfile, $scannedValue . " ");
//     }

//     unset($_POST);
//     header("Location: profile");
//     exit;
// }


// echo basename(__FILE__, '.php');


require_once "views/profileview.php";
