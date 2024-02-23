<?php

$db = new MySQLDB();

// $db->mysql_error("delete", "items");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);

    if ($data) {
        if (is_array($data)) {

            if ($data["action"] == "delete_evidencija") { // ako je action delete_evidencija, poništavanje evidencije prema id
                $deleted_ids = array();

                foreach ($data["ids"] as $id) {
                    $deleted_ids[] = $id;

                    $db->update("UPDATE vl_evidencija set aktivno=0 WHERE id=?", array($id));
                }

                // vraca ID-je koji su izbrisani
                $response = array(
                    'message' => 'Items deleted successfully',
                    'deleted_ids' => $deleted_ids
                );
                echo json_encode($response);
            }

            if ($data["action"] == "promjena_stanja") {
                $proizvod_id = $data["data"]["proizvod_id"];
                $ucionica_id = $data["data"]["ucionica_id"];
                $kolicina = $data["data"]["kolicina"];
                $vrsta = $data["data"]["vrsta"];

                if ($vrsta == "novo") {
                    $db->insert("INSERT INTO vl_stanje (proizvod_id, ucionica_id, kolicina) VALUES (?,?,?)", array($proizvod_id, $ucionica_id, $kolicina));
                } elseif ($vrsta == "kolicina") {
                    $db->update("UPDATE vl_stanje SET kolicina=? WHERE proizvod_id=? AND ucionica_id=?", array($kolicina, $proizvod_id, $ucionica_id));
                } elseif ($vrsta == "nestalo") {
                    $db->update("UPDATE vl_stanje SET otpisano=1 WHERE proizvod_id=? AND ucionica_id=?", array($proizvod_id, $ucionica_id));
                }
                echo json_encode(["response" => "success"]);
            }

            if ($data["action"] == "change_role") {
                $id = $data["data"]["id"];
                $role = $data["data"]["role"];
                $db->update("UPDATE vl_users SET role=? WHERE id=?", array($role, $id));
            }
        } else {
            // krivi podaci, JSON nije array
            http_response_code(400);
            echo json_encode(array('error' => 'Nevažeći JSON format'));
        }
    } else {
        // krivi JSON format ili nemoze procitati
        http_response_code(400);
        echo json_encode(array('error' => 'Nevažeći JSON format ili se podaci ne mogu čitati'));
    }
} else {
    // ako nije POST
    http_response_code(405);
    echo json_encode(array('error' => 'Nevažeći način zahtjeva'));
}
