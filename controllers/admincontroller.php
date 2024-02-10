<?php

// provjerava ako je user admin, ako nije nema pristup ovoj stranici
checkRole("admin");

function getProizvodi($order = "") // funkcija koja vraca sve proizvode
{
    global $db;

    return $db->select(
        "SELECT vl_proizvodi.*, vl_tipovi_proizvoda.tip, vl_barkodovi.barkod FROM vl_proizvodi 
        INNER JOIN vl_barkodovi 
        ON vl_proizvodi.id=vl_barkodovi.proizvod_id
        INNER JOIN vl_tipovi_proizvoda
        ON vl_tipovi_proizvoda.id=vl_proizvodi.tip_id
        ORDER BY id DESC"
    );
}

function getStanje()
{
    global $db;

    $sql = "SELECT vl_stanje.*, vl_ucionice.oznaka AS ucionica, vl_barkodovi.barkod, vl_proizvodi.naziv FROM vl_stanje
            INNER JOIN vl_barkodovi
            ON vl_barkodovi.proizvod_id=vl_stanje.proizvod_id
            INNER JOIN vl_ucionice
            ON vl_ucionice.id=vl_stanje.ucionica_id
            INNER JOIN vl_proizvodi
            ON vl_proizvodi.id=vl_stanje.proizvod_id";

    $result = $db->select($sql);
    return $result;
}

// function getPromjene($id1, $id2) // prvo novija inventura pa starija kao argumenti (id)
// {
//     global $db;

//     function compareById($a, $b)
//     {
//         return $a['proizvod_id'] - $b['proizvod_id'];
//     }

//     $sql = "SELECT ime, prezime, vl_evidencija.*, vl_barkodovi.barkod, vl_users.username as username, vl_ucionice.oznaka as ucionica, vl_proizvodi.naziv
//     FROM vl_evidencija 
//     INNER JOIN vl_users ON vl_evidencija.user_id = vl_users.id 
//     INNER JOIN vl_ucionice ON vl_evidencija.ucionica_id = vl_ucionice.id 
//     INNER JOIN vl_proizvodi ON vl_evidencija.proizvod_id = vl_proizvodi.id 
//     INNER JOIN vl_barkodovi ON vl_barkodovi.proizvod_id = vl_evidencija.proizvod_id 
//     WHERE aktivno = 1 AND inventura_id=?";

//     $promjene = array(
//         "result" => array(),
//         "row_count" =>  0,
//     );

//     $result1 = $db->select($sql, array($id1), key: "proizvod_id")["result"];
//     $result2 = $db->select($sql, array($id2), key: "proizvod_id")["result"];

//     foreach ($result1 as $key => $row) {
//         $promjene["result"][$key] = $row;
//         if (array_key_exists($key, $result2)) {

//             if ($result2[$key]["ucionica"] != $row["ucionica"]) {
//                 $promjene["result"][$key]["promjena"] = "ucionica";
//                 $promjene["result"][$key]["ucionica"] = $result2[$key]["ucionica"] . " -> " . $row["ucionica"];
//                 $promjene["row_count"]++;
//             } else {
//                 $promjene["result"][$key]["promjena"] = "nema";
//                 $promjene["row_count"]++;
//             }
//         } else {
//             $promjene["result"][$key]["promjena"] = "novo";
//             $promjene["row_count"]++;
//         }
//     }

//     foreach ($result2 as $key => $row) {
//         if (!array_key_exists($key, $result1)) {
//             $promjene["result"][$key] = $row;
//             $promjene["result"][$key]["promjena"] = "nestalo";
//             $promjene["row_count"]++;
//         }
//     }


//     // dd($promjene["result"][239]);

//     usort($promjene["result"], 'compareById');
//     return $promjene;
// }

function getPromjene($id) // id zadnje inventure
{
    global $db;

    function compareById($a, $b)
    {
        return $a['proizvod_id'] - $b['proizvod_id'];
    }

    // sql za zadnju evidenciju
    $sql1 = "SELECT ime, prezime, vl_evidencija.*, vl_barkodovi.barkod, vl_users.username as username, vl_ucionice.id as ucionica_id, 
        vl_ucionice.oznaka as ucionica, vl_proizvodi.naziv
        FROM vl_evidencija 
        INNER JOIN vl_users ON vl_evidencija.user_id = vl_users.id 
        INNER JOIN vl_ucionice ON vl_evidencija.ucionica_id = vl_ucionice.id 
        INNER JOIN vl_proizvodi ON vl_evidencija.proizvod_id = vl_proizvodi.id 
        INNER JOIN vl_barkodovi ON vl_barkodovi.proizvod_id = vl_evidencija.proizvod_id 
        WHERE vl_evidencija.aktivno = 1 AND inventura_id=?";

    // sql za stanje
    $sql2 = "SELECT vl_stanje.proizvod_id, vl_stanje.kolicina as kolicina, vl_barkodovi.barkod, vl_ucionice.id as ucionica_id, 
        vl_ucionice.oznaka as ucionica, vl_proizvodi.naziv
        FROM vl_stanje 
        INNER JOIN vl_ucionice ON vl_stanje.ucionica_id = vl_ucionice.id 
        INNER JOIN vl_proizvodi ON vl_stanje.proizvod_id = vl_proizvodi.id 
        INNER JOIN vl_barkodovi ON vl_barkodovi.proizvod_id = vl_stanje.proizvod_id";

    $promjene = array(
        "result" => array(),
        "row_count" =>  0,
    );

    $result1 = $db->select($sql1, array($id), key: "proizvod_id")["result"];
    $result2 = $db->select($sql2, key: "proizvod_id")["result"];

    $dodano = array();
    $i = 0;

    foreach ($result1 as $key => $row) {
        $promjene["result"][$i] = $row;
        $dodano[$i] = $key;
        if (array_key_exists($key, $result2)) {

            if ($result2[$key]["ucionica"] != $row["ucionica"]) {
                $promjene["result"][$i]["promjena"] = "ucionica";
                $promjene["result"][$i]["ucionica"] = $result2[$key]["ucionica"] . " -> " . $row["ucionica"];
                $promjene["result"][$i]["ucionica_stara"] = $result2[$key]["ucionica_id"];
                $promjene["result"][$i]["ucionica_nova"] = $row["ucionica_id"];
                $promjene["row_count"]++;
            } else {
                $promjene["result"][$i]["promjena"] = "nema";
                $promjene["row_count"]++;
            }
        } else {
            $promjene["result"][$i]["promjena"] = "novo";
            $promjene["row_count"]++;
        }
        $i++;
    }

    foreach ($result2 as $key => $row) {
        if (!array_key_exists($key, $result1)) {
            $promjene["result"][$i] = $row;
            $promjene["result"][$i]["promjena"] = "nestalo";
            $promjene["row_count"]++;
            $i++;
        }
    }


    // foreach ($result1 as $key => $row) {
    //     $promjene["result"][$key] = $row;
    //     if (array_key_exists($key, $result2)) {

    //         if ($result2[$key]["ucionica"] != $row["ucionica"]) {
    //             $promjene["result"][$key]["promjena"] = "ucionica";
    //             $promjene["result"][$key]["ucionica"] = $result2[$key]["ucionica"] . " -> " . $row["ucionica"];
    //             $promjene["result"][$key]["ucionica_stara"] = $result2[$key]["ucionica_id"];
    //             $promjene["result"][$key]["ucionica_nova"] = $row["ucionica_id"];
    //             $promjene["row_count"]++;
    //         } else {
    //             $promjene["result"][$key]["promjena"] = "nema";
    //             $promjene["row_count"]++;
    //         }
    //     } else {
    //         $promjene["result"][$key]["promjena"] = "novo";
    //         $promjene["row_count"]++;
    //     }
    // }

    // foreach ($result2 as $key => $row) {
    //     if (!array_key_exists($key, $result1)) {
    //         $promjene["result"][$key] = $row;
    //         $promjene["result"][$key]["promjena"] = "nestalo";
    //         $promjene["row_count"]++;
    //     }
    // }


    // dd($promjene["result"][239]);

    usort($promjene["result"], 'compareById');
    return $promjene;
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

    $result = $db->select("SELECT * FROM vl_ucionice");

    return $result;
}

function getTipovi() // vraca sve tipove proizvoda
{
    global $db;

    $result = $db->select("SELECT * FROM vl_tipovi_proizvoda");

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
$proizvod_upload_msg = "Uspješno uploadano";
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
        $barkod = "200000" . str_pad($insert_id, 6, '0', STR_PAD_LEFT);
        $barkod .= calculateEAN13CheckDigit($barkod);
        $db->update("UPDATE vl_ucionice SET barkod=? WHERE id=?", array($barkod, $insert_id));
    }

    if (isset($_POST["uredi_ucionicu"])) {
        $oznaka = $_POST["oznaka"];
        $opis = $_POST["opis"] != "" ? $_POST["opis"] : "Nema opisa";
        $id = $_POST["id"];

        $db->update("UPDATE vl_ucionice SET oznaka=?, opis=? WHERE id=?", array($oznaka, $opis, $id));
    }

    if (isset($_POST["pokreni_inventuru"])) {
        $result = $db->select_one("SELECT * FROM vl_inventura ORDER BY id DESC LIMIT 1");
        if ($result["row_count"] > 0) {
            if ($result["result"]["aktivno"] == 0) { // dodaje novu sa pocetkom
                $db->insert("INSERT INTO vl_inventura (pocetak) VALUES (?)", array(date("Y-m-d H:i:s")));
            } else { // ako je pokrenuta dodaje kraj
                $inventura_id = $db->select_one("SELECT * FROM vl_inventura ORDER BY id DESC LIMIT 1")["result"]["id"];
                $db->update("UPDATE vl_inventura SET kraj=?, aktivno=0 WHERE id=?", array(date("Y-m-d H:i:s"), $inventura_id));
            }
        } else { // ako ne postoji dodaje inventuru
            $db->insert("INSERT INTO vl_inventura (pocetak) VALUES (?)", array(date("Y-m-d H:i:s")));
        }
    }

    if (isset($_POST["dodaj_proizvod"])) {

        if (post("tip") && post("naziv") && post("opis") && post("kolicina") && post("tip") && post("vrij") && post("koef") && post("ucionica")) {

            $sql = "INSERT INTO vl_proizvodi (tip_id, naziv, opis, pocetna_vrij, vrij_knjig, koef) 
            VALUES (?, ?, ?, ?, ?, ?)";
            $insert_id = $db->insert($sql, array(post("tip"), post("naziv"), post("opis"), post("vrij"), post("vrij"), post("koef")))["insert_id"];

            $sql = "INSERT INTO vl_stanje (proizvod_id, ucionica_id, kolicina) VALUES (?, ?, ?)";
            $db->insert($sql, array($insert_id, post("ucionica"), post("kolicina")));

            $file_name = $_FILES["slika"]["name"];
            $temp_name = $_FILES["slika"]["tmp_name"];
            $file_info = pathinfo($file_name);

            $file_extension = $file_info['extension'];

            $new_name = "proizvod_" . $insert_id . "." . $file_extension; // TODO popraviti dodavanje imena

            $upload_dir = "images/";

            $target_path = $upload_dir . $new_name;

            if (getimagesize($temp_name) !== false) {
                $allowed_types = array("image/jpeg", "image/png");
                $file_type = mime_content_type($temp_name);

                if (in_array($file_type, $allowed_types)) {
                    if (move_uploaded_file($temp_name, $target_path)) {
                        $proizvod_upload_msg = "Slika uspješno poslana";

                        $db->update("UPDATE vl_proizvodi SET slika=? WHERE id=?", array($new_name, $insert_id));
                    } else {
                        $proizvod_upload_msg = "Greška pri slanju slike";
                    }
                } else {
                    $proizvod_upload_msg = "Krivi format slike (samo PNG i JPG)";
                }
            } else {
                $proizvod_upload_msg = "Krivi format datoteke, dopuštene samo slike";
            }
        }
    }

    if (isset($_POST["dodaj_tip"])) {
        if (post("tip_naziv")) {
            $tip = post("tip_naziv");
            $db->insert("INSERT INTO vl_tipovi_proizvoda (tip) VALUES (?)", array($tip));
        }
    }
}

// varijable za view-ove
$inventura_aktivna = checkInventura();
$pocetak_inventure = $inventura_aktivna ? pocetakInventure() : "";
$zadnja_inventura = zadnjaInventura();

// ucitavanje stranice ovisno o ruti, ako ne postoji odlazi na 404
if ($sub_route == "") { // TODO napraviti routing kak na index.php
    require_once "views/admin/adminview.php";
} elseif ($sub_route == "evidencija") {
    require_once "views/admin/evidencija.php";
} elseif ($sub_route == "ucionice") {
    require_once "views/admin/ucionice.php";
} elseif ($sub_route == "profesori") {
    require_once "views/admin/profesori.php";
} elseif ($sub_route == "proizvodi") {
    require_once "views/admin/proizvodi.php";
} elseif ($sub_route == "usporedba") {
    require_once "views/admin/usporedba.php";
} elseif ($sub_route == "stanje") {
    require_once "views/admin/stanje.php";
} else {
    header("Location: " . DS . APPFOLDER . DS . "404");
    exit;
}
