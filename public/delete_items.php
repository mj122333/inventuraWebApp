<?php
require_once "config/config.php";
require_once "mysqldb.class.php";

$db = new MySQLDB();

// $db->mysql_error("delete", "items");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);

    if ($data) {
        if (is_array($data)) {
            $deletedItems = array();

            foreach ($data as $id) {
                $deletedItems[] = $id;

                $db->delete("DELETE FROM evidencija WHERE id=?", array($id));
            }

            // vraca ID-je koji su izbrisani
            $response = array(
                'message' => 'Items deleted successfully',
                'deletedItems' => $deletedItems
            );
            echo json_encode($response);
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
