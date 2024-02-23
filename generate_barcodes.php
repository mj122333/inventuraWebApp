<?php
require_once __DIR__ . '/vendor/autoload.php';

// use FPDF\FPDF;

use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorSVG;


function generate_barcodes_proizvodi()
{
    global $db;

    $barcodes_folder = 'barcodes/';

    $sql = "SELECT * from vl_barkodovi";
    $result = $db->select($sql);
    $barkodovi = array();
    if ($result["row_count"] != 0) {
        foreach ($result["result"] as $row) {
            $barkodovi[] = $row["barkod"];
        }
    }

    // print_r(count($barkodovi));
    // echo "<br>";

    $sql = "SELECT * FROM vl_proizvodi";
    $result = $db->select($sql)["result"];
    $counter = 0;

    foreach ($result as $row) {
        $ID = $row['id'];
        $tip = $row['tip_id'];

        $barcodeData = "10" . str_pad($tip, 4, '0', STR_PAD_LEFT) . str_pad($ID, 6, '0', STR_PAD_LEFT);
        $barcodeData .= calculateEAN13CheckDigit($barcodeData);
        $barcode_file_path = $barcodes_folder . "code_{$barcodeData}.svg";

        if (!file_exists($barcode_file_path)) {
            $generator = new BarcodeGeneratorSVG();
            $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_EAN_13);
            file_put_contents($barcode_file_path, $barcodeImage);
            $counter++;
        }

        if (!in_array($barcodeData, $barkodovi)) {
            $sql = "INSERT INTO vl_barkodovi (proizvod_id, barkod) VALUES (?, ?)";
            $db->insert($sql, array($ID, $barcodeData));
        }
    }

    return $counter;
}

function generate_barcodes_ucionice()
{
    global $db;

    $barcodes_folder = 'barcodes/';

    $sql = "SELECT * from vl_ucionice";
    $result = $db->select($sql);
    $barkodovi = array();
    if ($result["row_count"] != 0) {
        foreach ($result["result"] as $row) {
            $barkodovi[] = $row["barkod"];
        }
    }

    // print_r(count($barkodovi));
    // echo "<br>";

    $sql = "SELECT * FROM vl_ucionice";
    $result = $db->select($sql)["result"];
    $counter = 0;

    foreach ($result as $row) {
        $ID = $row['id'];

        $barcodeData = "200000" . str_pad($ID, 6, '0', STR_PAD_LEFT);
        $barcodeData .= calculateEAN13CheckDigit($barcodeData);
        $barcode_file_path = $barcodes_folder . "code_{$barcodeData}.svg";

        if (!file_exists($barcode_file_path)) {
            $generator = new BarcodeGeneratorSVG();
            $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_EAN_13);
            file_put_contents($barcode_file_path, $barcodeImage);
            $counter++;
        }

        if (!in_array($barcodeData, $barkodovi)) {
            $sql = "UPDATE vl_ucionice SET barkod=? WHERE id=?";
            $db->insert($sql, array($barcodeData, $ID));
        }
    }

    return $counter;
}


function generate_barcodes_proizvodiPNG()
{
    global $db;

    $barcodes_folder = 'barcodes/';

    $sql = "SELECT * from vl_barkodovi";
    $result = $db->select($sql);
    $barkodovi = array();
    if ($result["row_count"] != 0) {
        foreach ($result["result"] as $row) {
            $barkodovi[] = $row["barkod"];
        }
    }

    // print_r(count($barkodovi));
    // echo "<br>";

    $sql = "SELECT * FROM vl_proizvodi";
    $result = $db->select($sql)["result"];
    $counter = 0;

    foreach ($result as $row) {
        $ID = $row['id'];
        $tip = $row['tip_id'];

        $barcodeData = "10" . str_pad($tip, 4, '0', STR_PAD_LEFT) . str_pad($ID, 6, '0', STR_PAD_LEFT);
        $barcodeData .= calculateEAN13CheckDigit($barcodeData);
        $barcode_file_path = $barcodes_folder . "code_{$barcodeData}.png";

        if (!file_exists($barcode_file_path)) {
            $generator = new BarcodeGeneratorPNG();
            $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_EAN_13);
            file_put_contents($barcode_file_path, $barcodeImage);
            $counter++;
        }

        if (!in_array($barcodeData, $barkodovi)) {
            $sql = "INSERT INTO vl_barkodovi (proizvod_id, barkod) VALUES (?, ?)";
            $db->insert($sql, array($ID, $barcodeData));
        }
    }

    return $counter;
}
