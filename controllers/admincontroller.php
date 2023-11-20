<?php



function getEvidencija()
{
    global $db;

    return $db->select("SELECT * FROM evidencija");
}

function checkRole($role)
{
    if (!isset($_SESSION["role"]) || $_SESSION["role"] !== $role) {
        header('HTTP/1.1 403 Forbidden');
        exit;
    }    
}

$kod = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["invite"])) {
        $kod = bin2hex(random_bytes(4));
    }

    $userID = $_SESSION["id"];
    $sql = "SELECT * FROM invite_codes WHERE user_id = ?";
    $result = $db->select($sql, array($userID));

    if ($result["row_count"] === 1) {
        $sql = "UPDATE invite_codes SET kod = ? WHERE user_id = ?";
        $db->update($sql, array($kod, $userID));
    } else {
        $sql = "INSERT INTO invite_codes (kod, user_id) VALUES (?, ?)";
        $db->insert($sql, array($kod, $userID));
    }
}



echo basename(__FILE__, '.php');


require_once "views/adminview.php";
