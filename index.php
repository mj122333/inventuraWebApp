<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inventura</title>
</head>

<body>

    <div class="popis">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="kod">
            <!-- <input type="text" name="id_proizvoda"> -->
            <input type="submit" value="submit">
        </form>
    </div>

    <?php
    $servername = "localhost";
    $username = "vito";
    $password = "micko";
    $dbname = "inventura";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $scannedValue = $_POST['kod'];
        if (!empty($scannedValue)) {
            // echo "<p>$scannedValue</p>";
            $sql = "INSERT INTO test (id) VALUES (" . $scannedValue . ")";
            mysqli_query($conn, $sql);
            $myfile = fopen("testfile.txt", "a");
            fwrite($myfile, $scannedValue . " ");
        }
    }

    ?>


</body>

</html>