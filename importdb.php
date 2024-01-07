<style>
    .barcode-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        /* Adjust the gap between columns as needed */
    }

    .barcode-item {
        text-align: center;
    }

    .input {
        width: 50%;
        height: 100px;
    }
</style>

<!-- <p>MySQL QUERY (odgovorno)</p>
<form action="importdb" method="get">
    <input class="input" type="text" name="q">
</form> -->

<?php

require_once __DIR__ . '/vendor/autoload.php';

// use FPDF\FPDF;

use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorSVG;

$barcodes_folder = 'barcodes/';

function generate_barcodes()
{
    global $db, $barcodes_folder;

    $sql = "SELECT * from vl_barkodovi";
    $result = $db->select($sql);
    $barkodovi = array();
    if ($result["row_count"] != 0) {
        foreach ($result["result"] as $row) {
            $barkodovi[] = $row["barkod"];
        }
    }

    print_r(count($barkodovi));

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

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["action"])) {
        if ($_GET["action"] == "generate_barcodes") {
            $c = generate_barcodes();
            echo "<br><b>BARKODOVI GENERIRANI: " . $c . "</b><br>";
        }
    }

    // if (isset($_GET["q"])) {
    //     $q = $_GET["q"];
    //     $db->select($q, array());
    // }

    // if (isset($_GET["import"])) {

    //     if ($_GET["import"] == "true") {
    //         $sqlFile = 'db/inventura.sql';

    //         $sql = file_get_contents($sqlFile);

    //         $queries = explode(';', $sql);

    //         foreach ($queries as $query) {
    //             $query = trim($query);

    //             if (!empty($query)) {
    //                 $result = $db->insert($query);

    //                 if (!$result) {
    //                     echo "Greška pri izvršavanju: " . $conn->error;
    //                 }
    //             }
    //         }
    //     }
    // }

    // if (isset($_GET["drop"])) {
    //     if ($_GET["drop"] == "vito123") {
    //         $tables = $db->select("SHOW TABLES")["result"];
    //         print_r($tables);
    //         foreach ($tables as $table) {
    //             $t = $table['Tables_in_jambrosi_inventura'];
    //             $db->delete("DROP TABLE IF EXISTS $t");
    //             echo "<span style='color: red;'>Tablica <b>" . $t . "</b> izbrisana.</span><br>";
    //         }
    //     }
    // }
}


function print_tables($conn)
{
    $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema = '" . DB_NAME . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<a href='#" . $row["TABLE_NAME"] . "'>Table: " . $row["TABLE_NAME"] . "</a><br>";
        }
    } else {
        echo "0 results";
    }
}

function get_all($conn)
{
    $tableQuery = "SHOW TABLES";
    $tablesResult = $conn->query($tableQuery);

    while ($table = $tablesResult->fetch_assoc()) {
        $tableName = $table['Tables_in_' . DB_NAME]; // Replace with your actual database name

        echo "<h2 id='$tableName' class='table-header' data-table='$tableName'>$tableName</h2>";

        // Get column names
        $columnQuery = "SHOW COLUMNS FROM $tableName";
        $columnsResult = $conn->query($columnQuery);
        $columns = array();
        while ($column = $columnsResult->fetch_assoc()) {
            $columns[] = $column['Field'];
        }

        // Print table header
        echo "<table style='display: none;' border='1' class='data-table' data-table='$tableName'><tr>";
        foreach ($columns as $column) {
            echo "<th>$column</th>";
        }
        echo "</tr>";

        // Get and print rows
        $dataQuery = "SELECT * FROM $tableName";
        $dataResult = $conn->query($dataQuery);

        while ($row = $dataResult->fetch_assoc()) {
            echo "<tr>";
            foreach ($columns as $column) {
                echo "<td>" . $row[$column] . "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }
}

function get_rows($conn, $table)
{
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<h1>" . $row["table_name"] . "</h1><br>";
        }
    } else {
        echo "0 results";
    }
}

function show_barcodes()
{
    global $db;
    $result = $db->select("SELECT barkod, vl_proizvodi.naziv FROM vl_barkodovi, vl_proizvodi WHERE vl_barkodovi.proizvod_id=vl_proizvodi.id;");

    echo "<p>Barkodova: " . $result["row_count"] . "</p>";

    $counter = 0;
    echo "<div style='border-bottom: solid 1px black;' class='barcode-container'>";

    foreach ($result["result"] as $row) {
        if ($counter % 3 == 0 && $counter > 0) {
            echo "</div><div style='border-bottom: solid 1px black;' class='barcode-container'>";
        }

        $barkod = $row["barkod"];
        echo "<div class='barcode-item'>";
        echo "<p>" . $row["naziv"] . "</p>";
        echo "<img src='barcodes/code_$barkod.svg' alt='Barcode for $barkod'><br>";
        echo "<p>" . $barkod . "</p>";
        echo "</div>";

        $counter++;
    }

    echo "</div>";
}

// function generatePDF()
// {
//     global $db;
//     $result = $db->select("SELECT barkod, vl_proizvodi.naziv FROM vl_barkodovi, vl_proizvodi WHERE vl_barkodovi.proizvod_id=vl_proizvodi.id;");

//     // Create a new PDF instance
//     $pdf = new PDF();
//     $pdf->AddPage();

//     $counter = 0;

//     foreach ($result["result"] as $row) {
//         if ($counter % 3 == 0 && $counter > 0) {
//             $pdf->Ln(); // Move to the next line after every 3 items
//         }

//         $barkod = $row["barkod"];
//         $pdf->Cell(60, 10, $row["naziv"], 1, 0, 'C');
//         $pdf->Ln();
//         $pdf->Image("barcodes/code_$barkod.png", $pdf->GetX(), $pdf->GetY(), 50, 0, 'PNG');
//         $pdf->Ln();
//         $pdf->Cell(60, 10, $barkod, 1, 0, 'C');

//         $counter++;
//     }

//     // Output the PDF to the browser
//     $pdf->Output();
// }



// echo "<b>importdb.php FILE UCITAN<br></b>";
// echo "<b>" . __FILE__ . "<br></b>";

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Spajanje nije uspješno: " . $conn->connect_error);
} else {
    echo "Spajanje uspješno <br>";
}

// print_tables($conn);
// get_all($conn);
show_barcodes();
// generatePDF();
?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.table-header').click(function() {
            var tableName = $(this).data('table');
            $('.data-table[data-table="' + tableName + '"]').toggle();
        });
    });
</script>