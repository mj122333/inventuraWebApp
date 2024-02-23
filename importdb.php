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

require_once 'generate_barcodes.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["action"])) {
        if ($_GET["action"] == "generate_barcodes") {
            $c1 = generate_barcodes_proizvodi();
            $c2 = generate_barcodes_ucionice();
            echo "<br><b>BARKODOVI GENERIRANI (PROIZVODI): " . $c1 . "</b><br>";
            echo "<br><b>BARKODOVI GENERIRANI (UČIONICE): " . $c2 . "</b><br>";
        }
    }
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
    $result = $db->select("SELECT barkod, vl_proizvodi.naziv, vl_proizvodi.id as proizvod_id FROM vl_barkodovi, vl_proizvodi WHERE vl_barkodovi.proizvod_id=vl_proizvodi.id;");

    echo "<p>Barkodova: " . $result["row_count"] . "</p>";

    $counter = 0;
    echo "<div style='border-bottom: solid 1px black;' class='barcode-container'>";

    foreach ($result["result"] as $row) {
        if ($counter % 3 == 0 && $counter > 0) {
            echo "</div><div style='border-bottom: solid 1px black;' class='barcode-container'>";
        }

        $barkod = $row["barkod"];
        echo "<div class='barcode-item'>";
        echo "<p>" . $row["naziv"] . " (ID: " . $row["proizvod_id"] . ")</p>";
        echo "<img src='barcodes/code_$barkod.svg' alt='Barcode for $barkod'><br>";
        echo "<p>" . $barkod . "</p>";
        echo "</div>";

        $counter++;
    }

    echo "</div>";


    $result = $db->select("SELECT * from vl_ucionice");

    echo "<p>Barkodova: " . $result["row_count"] . "</p>";

    $counter = 0;
    echo "<div style='border-bottom: solid 1px black;' class='barcode-container'>";

    foreach ($result["result"] as $row) {
        if ($counter % 3 == 0 && $counter > 0) {
            echo "</div><div style='border-bottom: solid 1px black;' class='barcode-container'>";
        }

        $barkod = $row["barkod"];
        echo "<div class='barcode-item'>";
        echo "<p>" . $row["oznaka"] . "</p>";
        echo "<img src='barcodes/code_$barkod.svg' alt='Barcode for $barkod'><br>";
        echo "<p>" . $barkod . "</p>";
        echo "</div>";

        $counter++;
    }

    echo "</div>";
}

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Spajanje nije uspješno: " . $conn->connect_error);
} else {
    echo "Spajanje uspješno <br>";
}

show_barcodes();
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