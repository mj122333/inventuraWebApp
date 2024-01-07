<?php


function getProizvodi($order = "") // funkcija koja vraca sve proizvode
{
    global $db;

    return $db->select(
        "SELECT vl_proizvodi.*, vl_tipovi_proizvoda.tip, vl_barkodovi.barkod FROM vl_proizvodi 
        INNER JOIN vl_barkodovi 
        ON vl_proizvodi.id=vl_barkodovi.proizvod_id
        INNER JOIN vl_tipovi_proizvoda
        ON vl_tipovi_proizvoda.id=vl_proizvodi.tip_id
        ORDER BY naziv ASC"
    );
}


function getEvidencija() // funkcija koja vraca evidentirane proizvode sa dodatnim uvjetima za sortiranje
{
    global $db, $u, $i, $p, $search, $order, $column;
    $params = array();
    $params[] = "%$search%";

    $where_u = "";
    $where_p = "";
    $order_by = " ORDER BY vl_evidencija.id ASC;";
    $where_i = " AND vl_evidencija.inventura_id=" . zadnjaInventura();

    if ($u != "") {
        $where_u = " AND vl_ucionice.oznaka = ?";
        $params[] = $u;
    }
    if ($i != "") {
        $where_i = " AND vl_evidencija.inventura_id = ?";
        $params[] = $i;
    }
    if ($p != "") {
        $where_p = " AND vl_evidencija.user_id = ?";
        $params[] = $p;
    }

    // $orders = array("asc", "desc");
    // if ($order != "" && $column != "") {
    //     $order_by = " ORDER BY ? ?;";
    //     $params[] = $column;
    //     $params[] = $order;
    // }

    $sql = "SELECT ime, prezime, vl_evidencija.*, vl_barkodovi.barkod, vl_users.username as username, vl_ucionice.oznaka as ucionica, vl_proizvodi.naziv
    FROM vl_evidencija 
    INNER JOIN vl_users ON vl_evidencija.user_id = vl_users.id 
    INNER JOIN vl_ucionice ON vl_evidencija.ucionica_id = vl_ucionice.id 
    INNER JOIN vl_proizvodi ON vl_evidencija.proizvod_id = vl_proizvodi.id 
    INNER JOIN vl_barkodovi ON vl_barkodovi.proizvod_id = vl_evidencija.proizvod_id 
    WHERE vl_proizvodi.naziv LIKE ? AND 
    aktivno = 1" . $where_u . $where_i . $where_p . $order_by;

    // print_r($sql);
    // echo "<br>";
    // print_r($params);
    // echo "<br>";
    return $db->select($sql, $params);
}

function getProfesoriEvidencija() // TODO provjeriti
{
    global $db;

    return $db->select(
        "SELECT DISTINCT vl_evidencija.*, vl_barkodovi.barkod, vl_users.username as username, vl_ucionice.oznaka as ucionica, vl_proizvodi.naziv
        FROM vl_evidencija
        INNER JOIN vl_users ON vl_evidencija.user_id = vl_users.id
        INNER JOIN vl_ucionice ON vl_evidencija.ucionica_id = vl_ucionice.id
        INNER JOIN vl_proizvodi ON vl_evidencija.proizvod_id = vl_proizvodi.id
        INNER JOIN vl_barkodovi ON vl_barkodovi.proizvod_id = vl_evidencija.proizvod_id
        WHERE aktivno = 1
        ORDER BY vl_evidencija.user_id ASC, vl_evidencija.id ASC;
        "
    );
}

function getProfesori() // vraca sve profesore tj. usere
{
    global $db;

    $result = $db->select("SELECT * FROM vl_users");

    return $result;
}

function profesorById($id) // vraca profesora ili usera prema id-u
{
    global $db;

    $result = $db->select_one("SELECT * FROM vl_users WHERE id=?", array($id))["result"];

    return $result["ime"] . " " . $result["prezime"];
}


function getUcionice() // vraca sve ucionice
{
    global $db;

    $result = $db->select("SELECT id, oznaka, opis FROM vl_ucionice");

    return $result;
}

function checkRole($role) // provjerava ako je userov role jednak parametru
{
    if (!isset($_SESSION["role"]) || $_SESSION["role"] !== $role) {
        // header('HTTP/1.1 403 Forbidden');
        header("Location: " . DS . APPFOLDER . DS . "403");
        exit;
    }
}

function zadnjaInventura() // vraca id zadnje inventure
{
    global $db;

    $result = $db->select_one("SELECT * FROM vl_inventura ORDER BY id DESC LIMIT 1");
    if ($result["row_count"] != 0) {
        return $result["result"]["id"];
    }
    return -1;
}

function checkInventura() // provjerava ako je zadnja inventura pokrenuta
{
    global $db;

    $result = $db->select_one("SELECT * FROM vl_inventura ORDER BY id DESC LIMIT 1");
    if ($result["row_count"] > 0) {
        if ($result["result"]["aktivno"] == 0) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}

function pocetakInventure() // vraca pocetak zadnje inventure
{
    global $db;

    $result = $db->select_one("SELECT * FROM vl_inventura ORDER BY id DESC LIMIT 1");
    return $result["result"]["pocetak"];
}


// varijable za view-ove
$search = "";
$action = "";
$order = "";
$column = "";
$u = "";
$p = "";


// postavalja varijable iz get zahtjeva
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $kod = "";

    if (isset($_GET["invite"])) {
        $kod = bin2hex(random_bytes(4));

        $userID = $_SESSION["id"];
        $sql = "SELECT * FROM vl_invite_codes WHERE user_id = ?";
        $result = $db->select($sql, array($userID));

        if ($result["row_count"] === 1) {
            $sql = "UPDATE vl_invite_codes SET kod = ? WHERE user_id = ?";
            $db->update($sql, array($kod, $userID));
        } else {
            $sql = "INSERT INTO vl_invite_codes (kod, user_id) VALUES (?, ?)";
            $db->insert($sql, array($kod, $userID));
        }
    }

    if (isset($_GET["order"]) && isset($_GET["column"])) {
        $order = $_GET["order"];
        $column = $_GET["column"];
    }

    if (isset($_GET["u"])) {
        $u = $_GET["u"];
    }

    if (isset($_GET["i"])) {
        $i = $_GET["i"];
    }

    if (isset($_GET["p"])) {
        $p = $_GET["p"];
    }

    if (isset($_GET["search"])) {
        $search = $_GET["search"];
    }

    if (isset($_GET["action"])) {
        $action = $_GET["action"];
    }
}

// dodavanje ucionice i pokretanje inventure, ovisno o post zahtjevu
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["dodaj_ucionicu"])) {
        $oznaka = $_POST["oznaka"];
        $opis = $_POST["opis"] != "" ? $_POST["opis"] : "Nema opisa";


        $insert_id = $db->insert("INSERT INTO vl_ucionice (oznaka, opis) VALUES (?, ?)", array($oznaka, $opis))["insert_id"];
        $barkod = "1" . str_pad($insert_id, 11, "0", STR_PAD_LEFT);
        $barkod .= calculateEAN13CheckDigit($barkod);
        $db->update("UPDATE vl_ucionice SET barkod=? WHERE id=?", array($barkod, $insert_id));
    }

    if (isset($_POST["pokreni_inventuru"])) {
        $result = $db->select_one("SELECT * FROM vl_inventura ORDER BY id DESC LIMIT 1");
        if ($result["row_count"] > 0) {
            if ($result["result"]["aktivno"] == 0) {
                $db->insert("INSERT INTO vl_inventura (pocetak) VALUES (?)", array(date("Y-m-d H:i:s")));
            } else {
                $inventura_id = $db->select_one("SELECT * FROM vl_inventura ORDER BY id DESC LIMIT 1")["result"]["id"];
                $db->update("UPDATE vl_inventura SET kraj=?, aktivno=0 WHERE id=?", array(date("Y-m-d H:i:s"), $inventura_id));
            }
        } else {
            $db->insert("INSERT INTO vl_inventura (pocetak) VALUES (?)", array(date("Y-m-d H:i:s")));
        }
    }
}

// varijable za view-ove
$inventura_aktivna = checkInventura();
$pocetak_inventure = $inventura_aktivna ? pocetakInventure() : "";
$zadnja_inventura = zadnjaInventura();


// provjerava ako je user admin, ako nije nema pristup ovoj stranici
checkRole("admin");

// ucitavanje stranice ovisno o ruti, ako ne postoji odlazi na 404
if ($sub_route == "") {
    require_once "views/admin/adminview.php";
} elseif ($sub_route == "evidencija") {
    require_once "views/admin/evidencija.php";
} elseif ($sub_route == "ucionice") {
    require_once "views/admin/ucionice.php";
} elseif ($sub_route == "profesori") {
    require_once "views/admin/profesori.php";
} elseif ($sub_route == "proizvodi") {
    require_once "views/admin/proizvodi.php";
} else {
    header("Location: " . DS . APPFOLDER . DS . "404");
    exit;
}
