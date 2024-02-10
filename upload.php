<?php

require_once __DIR__ . '/vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Picqer\Barcode\BarcodeGeneratorSVG;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ako je poslan value, skenirana vrijednost
    if (isset($_POST["value"])) {
        try {
            $value = $_POST["value"];

            if (substr($value, 0, 1) === "1") {
                // uzima id od zadnje inventure
                $inventura_id = $db->select_one("SELECT * FROM vl_inventura ORDER BY id DESC LIMIT 1");
                if ($inventura_id["row_count"] > 0) {

                    // ako nije zavrsila
                    if (empty($inventura_id["result"]["kraj"])) {

                        $sql = "INSERT INTO vl_scan (value, standard) VALUES (?, ?)";
                        $insert_id = $db->insert($sql, array($value, $_POST["standard"]))["insert_id"];

                        $ucionica_id = $_POST["ucionica"];
                        if ($ucionica_id != "null" && $ucionica_id != "") {
                            // vraca proizvod_id povezan sa tim barkodom
                            $proizvod_id = $db->select_one("SELECT proizvod_id FROM vl_barkodovi WHERE barkod=?", array($value))["result"]["proizvod_id"];

                            $currentDate = date('Y-m-d');
                            $currentTime = date('H:i:s');

                            $user_id = $_POST["user"];

                            // zapis evidencije proizvoda
                            // $sql = "INSERT INTO your_table (column1, column2, column3) VALUES (1, 2, 'value2')
                            // ON DUPLICATE KEY UPDATE column3 = 'value2';";
                            
                            // SELECT
                            //     proizvod_id,
                            //     ucionica_id,
                            //     COUNT(*) AS kolicina
                            // FROM
                            //     vl_evidencija
                            // WHERE
                            //     inventura_id=32
                            // GROUP BY
                            //     proizvod_id,
                            //     ucionica_id

                            $sql = "INSERT INTO vl_evidencija (proizvod_id, ucionica_id, datum, vrijeme, user_id, inventura_id) VALUES (?, ?, ?, ?, ?, ?)";
                            $db->insert($sql, array($proizvod_id, $ucionica_id, $currentDate, $currentTime, $user_id, $inventura_id["result"]["id"]));

                            // kreiranje barkoda u svg formatu
                            $barcodes_folder = "barcodes";
                            $barcodeData = $value;
                            $barcode_file_path = $barcodes_folder . DS . "code_{$barcodeData}.svg";
                            if (!file_exists($barcode_file_path)) {
                                $generator = new BarcodeGeneratorSVG();
                                $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_EAN_13);
                                file_put_contents($barcode_file_path, $barcodeImage);
                            }

                            header('Content-Type: application/json');
                            echo json_encode(["status" => "success", "vrsta" => "proizvod", "message" => "uspješno dodano"]);
                        } else {
                            header('Content-Type: application/json');
                            echo json_encode(["status" => "fail", "vrsta" => "proizvod", "message" => "nije skenirana učionica"]);
                        }
                    }
                }
            } elseif (substr($value, 0, 1) === "2") {

                $result = $db->select_one("SELECT * FROM vl_ucionice WHERE barkod=?", array($value));
                if ($result["row_count"] == 1) {
                    header('Content-Type: application/json');
                    echo json_encode(['ucionica_id' => $result["result"]["id"], "oznaka" => $result["result"]["oznaka"], "vrsta" => "ucionica", "status" => "success", "message" => "uspješno skenirano"]);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['ucionica_id' => NULL, "oznaka" => null, "vrsta" => "ucionica", "status" => "fail", "message" => "krivi barkod"]);
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(["status" => "fail", "vrsta" => "nema", "message" => "nevažeći barkod"]);
            }
        } catch (Exception $e) {
            $db->mysql_error("ERROR INSERT", $e);
        }
    }
    http_response_code(200);
}
