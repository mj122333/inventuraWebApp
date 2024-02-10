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
                $proizvod_id = $data["ids"]["proizvod_id"];
                $stara_ucionica = $data["ids"]["stara_ucionica"];
                $nova_ucionica = $data["ids"]["nova_ucionica"];

                $db->update("UPDATE vl_stanje SET ucionica_id=? WHERE proizvod_id=? AND ucionica_id=?", array($nova_ucionica, $proizvod_id, $stara_ucionica));
            }
        } else {
            // krivi podaci, JSON nije array
            http_response_code(400);
            echo json_encode(array('error' => 'Invalid JSON data'));
        }
    } else {
        // krivi JSON format ili nemoze procitati
        http_response_code(400);
        echo json_encode(array('error' => 'Invalid JSON format or unable to read data'));
    }
} else {
    // ako nije POST
    http_response_code(405);
    echo json_encode(array('error' => 'Invalid request method'));
}
