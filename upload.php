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

            // uzima id od zadnje inventure
            $inventura_id = $db->select_one("SELECT * FROM vl_inventura ORDER BY id DESC LIMIT 1");
            if ($inventura_id["row_count"] > 0) {

                // ako nije zavrsila
                if (empty($inventura_id["result"]["kraj"])) {

                    $sql = "INSERT INTO vl_scan (value, standard) VALUES (?, ?)";
                    $insert_id = $db->insert($sql, array($value, $_POST["standard"]))["insert_id"];

                    // vraca proizvod_id povezan sa tim barkodom
                    $proizvod_id = $db->select_one("SELECT proizvod_id FROM vl_barkodovi WHERE barkod=?", array($value))["result"]["proizvod_id"];

                    $currentDate = date('Y-m-d');
                    $currentTime = date('H:i:s');

                    // zapis evidencije proizvoda
                    $sql = "INSERT INTO vl_evidencija (proizvod_id, ucionica_id, datum, vrijeme, user_id, inventura_id) VALUES (?, ?, ?, ?, ?, ?)";
                    $db->insert($sql, array($proizvod_id, 5, $currentDate, $currentTime, rand(1, 3), $inventura_id["result"]["id"]));

                    // kreiranje barkoda u svg formatu
                    $barcodes_folder = "barcodes"; // TODO provjeriti ako vec ne postoji slika da se ne dodaje vise put
                    $barcodeData = $value;
                    $pngFilePath = $barcodes_folder . DS . "code_{$barcodeData}.png";
                    $generator = new BarcodeGeneratorPNG();
                    $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_EAN_13);
                    file_put_contents($pngFilePath, $barcodeImage);
                }
            }
        } catch (Exception $e) {
            $db->mysql_error("ERROR INSERT", $e);
        }
    }
    http_response_code(200);
}
