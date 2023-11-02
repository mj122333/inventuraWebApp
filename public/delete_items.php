<?php
require_once "config/config.php";
require_once "mysqldb.class.php";

$db = new MySQLDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);

    if ($data) {
        if (is_array($data)) {
            $deletedItems = array();

            foreach ($data as $id) {
                $deletedItems[] = $id;

                $db->delete("DELETE FROM evidencija WHERE id=?", array($id));
            }

            // Respond with a JSON message containing the IDs that were deleted
            $response = array(
                'message' => 'Items deleted successfully',
                'deletedItems' => $deletedItems
            );
            echo json_encode($response);
        } else {
            // Invalid JSON data
            http_response_code(400);
            echo json_encode(array('error' => 'Invalid JSON data'));
        }
    } else {
        // Invalid JSON format or unable to read JSON data
        http_response_code(400);
        echo json_encode(array('error' => 'Invalid JSON format or unable to read data'));
    }
} else {
    // Invalid request method
    http_response_code(405);
    echo json_encode(array('error' => 'Invalid request method'));
}
